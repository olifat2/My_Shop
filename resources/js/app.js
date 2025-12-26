document.addEventListener('DOMContentLoaded', () => {

    // ---------- CAROUSEL ----------
    initCarousel();
    // ---------- HEADER MOBILE ----------
    initMobileHeader();
    // ---------- SIDEBAR ADMIN ----------
    initAdminSidebar();
    // ---------- PROFILE DROPDOWN ----------
    initProfileDropdown();
    // ---------- TABLE FILTER ----------
    initTableFilter();
    // ---------- CLIENT PRODUCT FILTER ----------
    initClientProductFilter();
    // ---------- MINI-CART AJAX ----------
    initMiniCartAjax();

});

// ================== FONCTIONS ==================
function initCarousel() {
    const slides = document.querySelectorAll('.slide');
    const prev = document.querySelector('.prev');
    const next = document.querySelector('.next');
    const dots = document.querySelectorAll('.dot');
    if (!slides.length || !prev || !next || !dots.length) return;

    let index = 0;
    const showSlide = i => {
        slides.forEach((s, j) => s.classList.toggle('active', j === i));
        dots.forEach((d, j) => d.classList.toggle('active', j === i));
    };

    prev.addEventListener('click', () => { index = (index - 1 + slides.length) % slides.length; showSlide(index); });
    next.addEventListener('click', () => { index = (index + 1) % slides.length; showSlide(index); });
    dots.forEach(dot => dot.addEventListener('click', () => { index = Number.parseInt(dot.dataset.index); showSlide(index); }));
}

function initMobileHeader() {
    const navToggle = document.getElementById('nav-toggle');
    const navMenu = document.getElementById('nav-menu');
    if (!navToggle || !navMenu) return;

    const closeMenu = () => {
        navMenu.classList.remove('open');
        navToggle.classList.remove('active');
        navToggle.setAttribute('aria-expanded', 'false');
    };

    navToggle.addEventListener('click', e => {
        e.stopPropagation();
        const isOpen = navMenu.classList.toggle('open');
        navToggle.classList.toggle('active', isOpen);
        navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    document.addEventListener('keydown', e => { if (e.key === 'Escape' && navMenu.classList.contains('open')) closeMenu(); });
    document.addEventListener('click', e => { if (navMenu.classList.contains('open') && !navMenu.contains(e.target) && e.target !== navToggle) closeMenu(); });
    navMenu.querySelectorAll('a').forEach(link => link.addEventListener('click', closeMenu));
}

function initAdminSidebar() {
    const toggleBtn = document.getElementById('toggleSidebar');
    const closeBtn = document.getElementById('closeSidebar');
    const sidebar = document.getElementById('adminSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    if (!toggleBtn || !closeBtn || !sidebar || !overlay) return;

    const closeSidebar = () => { sidebar.classList.remove('open'); overlay.classList.remove('show'); };
    toggleBtn.addEventListener('click', () => { sidebar.classList.add('open'); overlay.classList.add('show'); });
    closeBtn.addEventListener('click', closeSidebar);
    overlay.addEventListener('click', closeSidebar);
}

function initProfileDropdown() {
    const profileToggle = document.getElementById('profileToggle');
    const profileDropdown = document.getElementById('profileDropdown');
    if (!profileToggle || !profileDropdown) return;

    profileToggle.addEventListener('click', e => { e.stopPropagation(); profileDropdown.classList.toggle('active'); });
    document.addEventListener('click', () => profileDropdown.classList.remove('active'));
    profileDropdown.addEventListener('click', e => e.stopPropagation());
}

function initTableFilter() {
    const searchInput = document.getElementById('productSearch');
    const categoryFilter = document.getElementById('categoryFilter');
    const stockFilter = document.getElementById('stockFilter');
    const rows = document.querySelectorAll('.table-product tbody tr');
    if (!searchInput && !categoryFilter && !stockFilter) return;

    const filterProducts = () => {
        const search = searchInput?.value.toLowerCase() || '';
        const category = categoryFilter?.value || '';
        const stock = stockFilter?.value || '';
        rows.forEach(row => {
            const name = row.dataset.name?.toLowerCase() || '';
            const rowCategory = row.dataset.category || '';
            const qty = NumberparseInt(row.dataset.stock, 10) || 0;
            let visible = true;
            if (search && !name.includes(search)) visible = false;
            if (category && rowCategory !== category) visible = false;
            if (stock === 'in' && qty <= 10) visible = false;
            if (stock === 'low' && (qty <= 0 || qty > 10)) visible = false;
            if (stock === 'out' && qty > 0) visible = false;
            row.style.display = visible ? '' : 'none';
        });
    };
    [searchInput, categoryFilter, stockFilter].forEach(el => el?.addEventListener('input', filterProducts));
}

function initClientProductFilter() {
    const searchInput = document.getElementById('productSearch');
    const categoryFilter = document.getElementById('categoryFilter');
    const products = document.querySelectorAll('.product-card');
    if (!searchInput && !categoryFilter) return;

    const filterProducts = () => {
        const search = searchInput?.value.toLowerCase() || '';
        const category = categoryFilter?.value || '';
        products.forEach(p => {
            const name = p.dataset.name?.toLowerCase() || '';
            const rowCategory = p.dataset.category || '';
            let visible = true;
            if (search && !name.includes(search)) visible = false;
            if (category && rowCategory !== category) visible = false;
            p.style.display = visible ? '' : 'none';
        });
    };
    [searchInput, categoryFilter].forEach(el => el?.addEventListener('input', filterProducts));
}

function initMiniCartAjax() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    const miniCart = document.getElementById('miniCart');
    const cartLink = document.querySelector('.cart-link');
    if (!cartLink || !miniCart) return;

    const numberFormat = num => new Intl.NumberFormat('fr-FR').format(num);
    const showToast = msg => {
        const toast = document.createElement('div');
        toast.className = 'cart-toast';
        toast.textContent = msg;
        document.body.appendChild(toast);
        setTimeout(() => toast.classList.add('show'), 10);
        setTimeout(() => toast.remove(), 2500);
    };
    const updateCartCount = count => {
        let badge = document.querySelector('.cart-count');
        if (badge) { badge.textContent = count; badge.style.display = count > 0 ? 'inline-flex' : 'none'; }
        else if (count > 0) {
            const span = document.createElement('span');
            span.className = 'cart-count';
            span.textContent = count;
            cartLink.appendChild(span);
        }
    };

    cartLink.addEventListener('click', e => { e.preventDefault(); miniCart.classList.toggle('active'); });
    document.addEventListener('click', e => { if (!miniCart.contains(e.target) && !cartLink.contains(e.target)) miniCart.classList.remove('active'); });

    document.body.addEventListener('submit', e => {
        const form = e.target.closest('.product-card form, .update-cart-form, .remove-cart-form');
        if (!form) return;
        e.preventDefault();

        const action = form.getAttribute('action');
        let body = null;
        if (form.classList.contains('update-cart-form')) {
            body = JSON.stringify({ qty: form.querySelector('input[name="qty"]').value });
        }

        fetch(action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': body ? 'application/json' : 'application/x-www-form-urlencoded'
            },
            body: body
        })
            .then(res => res.json())
            .then(data => {
                if (!data.success) return;
                handleCartUpdate(form, data, miniCart, numberFormat, showToast, updateCartCount);
            })
            .catch(err => console.error('Cart AJAX error:', err));
    });
}

function handleCartUpdate(form, data, miniCart, numberFormat, showToast, updateCartCount) {
    updateCartCount(data.count);

    if (miniCart && data.items) {
        rebuildMiniCart(miniCart, data, numberFormat);
    }

    if (form.classList.contains('update-cart-form')) {
        updateQuantity(form, data, numberFormat, showToast);
    }

    if (form.classList.contains('remove-cart-form')) {
        removeCartItem(form, data, miniCart, numberFormat, showToast);
    }
}

// ---------- Sous-fonctions ----------

function rebuildMiniCart(miniCart, data, numberFormat) {
    miniCart.innerHTML = '';

    // Titre
    const title = document.createElement('h3');
    title.textContent = 'Mon panier';
    miniCart.appendChild(title);

    // Items
    const itemsContainer = document.createElement('div');
    itemsContainer.className = 'mini-cart-items';

    Object.values(data.items).forEach(item => {
        const div = document.createElement('div');
        div.className = 'mini-cart-item';
        div.dataset.id = item.id;
        div.innerHTML = `
            <span class="item-name">${item.name}</span>
            <span class="item-qty">x${item.qty}</span>
            <span class="item-subtotal">${numberFormat(item.subtotal)} FCFA</span>
        `;
        itemsContainer.appendChild(div);
    });

    miniCart.appendChild(itemsContainer);

    // Total et bouton
    if (Object.keys(data.items).length > 0) {
        const totalDiv = document.createElement('div');
        totalDiv.className = 'mini-cart-total';
        totalDiv.innerHTML = `<strong>Total :</strong> <span>${numberFormat(data.total)} FCFA</span>`;
        miniCart.appendChild(totalDiv);

        const checkoutLink = document.createElement('a');
        checkoutLink.href = '/cart';
        checkoutLink.className = 'btn btn-primary btn-checkout';
        checkoutLink.textContent = 'Voir le panier / Commander →';
        miniCart.appendChild(checkoutLink);
    } else {
        const emptyP = document.createElement('p');
        emptyP.textContent = 'Votre panier est vide';
        miniCart.appendChild(emptyP);
    }
}

function updateQuantity(form, data, numberFormat, showToast) {
    const row = form.closest('tr');
    if (row) row.querySelector('td:nth-child(4)').textContent = numberFormat(data.itemSubtotal) + ' FCFA';

    const totalElem = document.querySelector('.cart-summary span');
    if (totalElem) totalElem.textContent = numberFormat(data.total) + ' FCFA';

    showToast('Quantité mise à jour !');
}

function removeCartItem(form, data, miniCart, numberFormat, showToast) {
    const row = form.closest('.mini-cart-item, tr');
    if (row) row.remove();

    const totalElem = document.querySelector('.cart-summary span');
    if (totalElem) totalElem.textContent = numberFormat(data.total) + ' FCFA';

    showToast('Produit retiré du panier !');

    if (data.total === 0 && miniCart) {
        miniCart.innerHTML = '<p>Votre panier est vide</p>';
    }
}

