<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $nom
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Produit_Capillaire> $produitCapillaire
 * @property-read int|null $produit_capillaire_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effets newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effets newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effets query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effets whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effets whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effets whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effets whereUpdatedAt($value)
 */
	class Effets extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $product_id
 * @property string $nature
 * @property string $marque
 * @property string $style
 * @property int $technique_pose_id
 * @property string $pcs
 * @property string $height
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\Technique_Pose|null $techniquePose
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meche_Extension newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meche_Extension newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meche_Extension query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meche_Extension whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meche_Extension whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meche_Extension whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meche_Extension whereMarque($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meche_Extension whereNature($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meche_Extension wherePcs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meche_Extension whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meche_Extension whereStyle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meche_Extension whereTechniquePoseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meche_Extension whereUpdatedAt($value)
 */
	class Meche_Extension extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nom
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Produit_Capillaire> $produitCapillaire
 * @property-read int|null $produit_capillaire_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nature_Actions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nature_Actions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nature_Actions query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nature_Actions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nature_Actions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nature_Actions whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nature_Actions whereUpdatedAt($value)
 */
	class Nature_Actions extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $categorie
 * @property string $poids
 * @property string $prix_unitaire
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Meche_Extension|null $mecheExtension
 * @property-read \App\Models\Produit_Capillaire|null $produitCapillaire
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Stock> $stock
 * @property-read int|null $stock_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCategorie($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product wherePoids($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product wherePrixUnitaire($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $product_id
 * @property string $nom
 * @property int $effet_id
 * @property int $nature_action_id
 * @property string $volume
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Effets|null $effet
 * @property-read \App\Models\Nature_Actions|null $natureAction
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit_Capillaire newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit_Capillaire newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit_Capillaire query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit_Capillaire whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit_Capillaire whereEffetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit_Capillaire whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit_Capillaire whereNatureActionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit_Capillaire whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit_Capillaire whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit_Capillaire whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit_Capillaire whereVolume($value)
 */
	class Produit_Capillaire extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $product_id
 * @property int $quantite
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock whereQuantite($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock whereUpdatedAt($value)
 */
	class Stock extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nom
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Meche_Extension> $mecheExtension
 * @property-read int|null $meche_extension_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Technique_Pose newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Technique_Pose newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Technique_Pose query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Technique_Pose whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Technique_Pose whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Technique_Pose whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Technique_Pose whereUpdatedAt($value)
 */
	class Technique_Pose extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $phone
 * @property string|null $imgProfil
 * @property string $role
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereImgProfil($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

