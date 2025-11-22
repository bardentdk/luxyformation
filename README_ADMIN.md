# Centre de Formation - Administration

## 📋 Vue d'ensemble

Site web moderne pour un centre de formation avec un panneau d'administration complet construit avec Laravel 12, Inertia.js (Vue 3), et Tailwind CSS 3.4.

## 🎨 Design

### Palette de couleurs
- **Primary (Titres)**: `#e1b656` - Doré élégant
- **Dark (Textes)**: `#171923` - Gris foncé
- **Background**: Blanc avec accents gris clairs

### Police
- **Inter** - Police moderne et lisible

## 🏗️ Structure du projet

```
luxyformation/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Admin/
│   │   │       ├── DashboardController.php
│   │   │       ├── UserController.php
│   │   │       ├── PostController.php
│   │   │       ├── FormationController.php
│   │   │       └── PageController.php
│   │   └── Middleware/
│   │       └── HandleInertiaRequests.php
│   └── Models/
│       ├── User.php
│       ├── Post.php
│       ├── Formation.php
│       └── Page.php
├── database/
│   └── migrations/
│       ├── *_create_posts_table.php
│       ├── *_create_formations_table.php
│       └── *_create_pages_table.php
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   ├── Components/
│   │   │   └── Admin/
│   │   │       ├── Modal.vue
│   │   │       ├── PageHeader.vue
│   │   │       └── Table.vue
│   │   ├── Layouts/
│   │   │   └── AdminLayout.vue
│   │   ├── Pages/
│   │   │   └── Admin/
│   │   │       ├── Dashboard.vue
│   │   │       ├── Users/
│   │   │       │   ├── Index.vue
│   │   │       │   ├── Create.vue
│   │   │       │   └── Edit.vue
│   │   │       ├── Posts/
│   │   │       ├── Formations/
│   │   │       └── Pages/
│   │   └── app.js
│   └── views/
│       └── app.blade.php
└── routes/
    └── web.php
```

## 🚀 Installation et Configuration

### 1. Installer les dépendances

```bash
composer install
npm install
```

### 2. Configuration de l'environnement

Copiez `.env.example` vers `.env` et configurez votre base de données :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=luxyformation
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Générer la clé d'application

```bash
php artisan key:generate
```

### 4. Créer la base de données

Créez une base de données MySQL nommée `luxyformation`.

### 5. Lancer les migrations

```bash
php artisan migrate
```

### 6. Compiler les assets

```bash
npm run build
# ou pour le développement
npm run dev
```

### 7. Lancer le serveur

```bash
php artisan serve
```

## 📊 Fonctionnalités Implémentées

### ✅ Dashboard
- Statistiques en temps réel
- Actions rapides
- Design moderne et intuitif

### ✅ Gestion des utilisateurs (CRUD complet)
- Liste paginée avec recherche
- Création d'utilisateurs
- Modification d'utilisateurs
- Suppression sécurisée

### 🔄 À implémenter (Posts, Formations, Pages)

Les contrôleurs de base sont créés. Voici comment implémenter chaque CRUD :

## 📝 Guide d'implémentation des CRUDs restants

### Posts (Blog)

**Contrôleur**: `app/Http/Controllers/Admin/PostController.php`

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::query()
            ->with('user')
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/Posts/Index', [
            'posts' => $posts,
            'filters' => $request->only(['search', 'status']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Posts/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:posts',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        $validated['user_id'] = auth()->id();

        Post::create($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Article créé avec succès.');
    }

    public function edit(Post $post)
    {
        return Inertia::render('Admin/Posts/Edit', [
            'post' => $post,
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:posts,slug,' . $post->id,
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        $post->update($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Article mis à jour avec succès.');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Article supprimé avec succès.');
    }
}
```

**Vue Index**: `resources/js/Pages/Admin/Posts/Index.vue`
- Utilisez le même pattern que `Users/Index.vue`
- Ajoutez des filtres pour le statut (draft/published)
- Affichez l'auteur de chaque post

**Champs du formulaire**:
- Title (text)
- Slug (text, auto-généré depuis le titre)
- Excerpt (textarea)
- Content (textarea ou éditeur riche)
- Featured Image (file upload ou URL)
- Status (select: draft/published)
- Published At (datetime)

### Formations

**Contrôleur**: `app/Http/Controllers/Admin/FormationController.php`

Similaire au PostController avec les champs :
- Title, Slug
- Description, Content
- Featured Image
- Duration (heures)
- Price (decimal)
- Level (select: débutant, intermédiaire, avancé)
- Max Participants (integer)
- Status (select: draft, published, archived)
- Start Date, End Date

### Pages

**Contrôleur**: `app/Http/Controllers/Admin/PageController.php`

Similaire au PostController avec les champs :
- Title, Slug
- Content
- Meta Title, Meta Description (SEO)
- Status (select: draft/published)
- Order (integer pour l'ordre d'affichage)
- Show in Menu (checkbox)

## 🎯 Composants réutilisables disponibles

### AdminLayout
```vue
<template>
  <AdminLayout>
    <!-- Votre contenu ici -->
  </AdminLayout>
</template>
```

### PageHeader
```vue
<PageHeader
  title="Titre de la page"
  description="Description de la page"
>
  <template #actions>
    <button class="btn btn-primary">Action</button>
  </template>
</PageHeader>
```

### Table
```vue
<Table :headers="headers">
  <tr v-for="item in items" :key="item.id">
    <!-- Vos cellules -->
  </tr>
</Table>
```

### Modal
```vue
<Modal :show="showModal" @close="showModal = false" title="Titre">
  <p>Contenu du modal</p>
  <template #footer>
    <button>Actions</button>
  </template>
</Modal>
```

## 🎨 Classes CSS personnalisées

### Boutons
```html
<button class="btn btn-primary">Primaire</button>
<button class="btn btn-secondary">Secondaire</button>
<button class="btn btn-outline">Outline</button>
```

### Cartes
```html
<div class="card">
  <!-- Contenu -->
</div>
```

### Formulaires
```html
<label class="label">Label</label>
<input class="input" type="text" />
```

## 🔐 Sécurité

- Authentification requise pour toutes les routes admin
- Protection CSRF automatique
- Validation des formulaires
- Soft delete sur tous les modèles
- Prévention de l'auto-suppression d'utilisateur

## 📱 Responsive Design

Le dashboard est entièrement responsive :
- **Mobile**: Menu hamburger, layout vertical
- **Tablet**: Layout adapté
- **Desktop**: Sidebar fixe, layout optimal

## 🚀 Prochaines étapes

1. Implémenter les CRUDs Posts, Formations, Pages (suivre le pattern UserController)
2. Ajouter un éditeur WYSIWYG (ex: TinyMCE, Quill)
3. Implémenter l'upload d'images
4. Ajouter la gestion des rôles/permissions
5. Créer le front-end public du site

## 📚 Ressources

- [Laravel 12 Documentation](https://laravel.com/docs/12.x)
- [Inertia.js](https://inertiajs.com/)
- [Vue 3](https://vuejs.org/)
- [Tailwind CSS](https://tailwindcss.com/)
- [Headless UI](https://headlessui.com/)

## 🤝 Support

Pour toute question ou problème, consultez la documentation officielle des technologies utilisées.

---

Développé avec ❤️ pour les centres de formation modernes.
