<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Helpers\Common;

class CheckPermission
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $routeName = $request->route()->getName();
        $permission = $this->generatePermissionName($routeName);
        if ($permission && !Common::has_permission($user->id, $permission)) {
            return redirect()->route('permission.denied');
        }
        return $next($request);
    }

    private function generatePermissionName($routeName)
    {
        $permissions = [
            'admin.admins.index' => 'view-admins',
            'admin.admins.create' => 'add-admins',
            'admin.admins.store' => 'add-admins',
            'admin.admins.edit' => 'edit-admins',
            'admin.admins.update' => 'edit-admins',
            'admin.admins.delete' => 'delete-admins',
    
            'admin.users.index' => 'view-users',
            'admin.users.create' => 'add-users',
            'admin.users.store' => 'add-users',
            'admin.users.edit' => 'edit-users',
            'admin.users.update' => 'edit-users',
            'admin.users.delete' => 'delete-users',
    
            'admin.project.index' => 'view-projects',
            'admin.project.create' => 'add-projects',
            'admin.project.store' => 'add-projects',
            'admin.project.edit' => 'edit-projects',
            'admin.project.update' => 'edit-projects',
            'admin.project.delete' => 'delete-projects',
    
            'admin.technology.index' => 'view-technologies',
            'admin.technology.create' => 'add-technologies',
            'admin.technology.store' => 'add-technologies',
            'admin.technology.edit' => 'edit-technologies',
            'admin.technology.update' => 'edit-technologies',
            'admin.technology.delete' => 'delete-technologies',
    
            'admin.blog.index' => 'view-blogs',
            'admin.blog.create' => 'add-blogs',
            'admin.blog.store' => 'add-blogs',
            'admin.blog.edit' => 'edit-blogs',
            'admin.blog.update' => 'edit-blogs',
            'admin.blog.delete' => 'delete-blogs',
    
            'admin.blogcategory.index' => 'view-blog-categories',
            'admin.blogcategory.create' => 'add-blog-categories',
            'admin.blogcategory.store' => 'add-blog-categories',
            'admin.blogcategory.edit' => 'edit-blog-categories',
            'admin.blogcategory.update' => 'edit-blog-categories',
            'admin.blogcategory.delete' => 'delete-blog-categories',
    
            'admin.blogtag.index' => 'view-blog-tags',
            'admin.blogtag.create' => 'add-blog-tags',
            'admin.blogtag.store' => 'add-blog-tags',
            'admin.blogtag.edit' => 'edit-blog-tags',
            'admin.blogtag.update' => 'edit-blog-tags',
            'admin.blogtag.delete' => 'delete-blog-tags',
    
            'admin.cms.index' => 'view-cms',
            'admin.cms.edit' => 'edit-cms',
            'admin.cms.update' => 'edit-cms',
    
            'admin.content.index' => 'view-cms-pages',
            'admin.content.create' => 'add-cms-pages',
            'admin.content.store' => 'add-cms-pages',
            'admin.content.edit' => 'edit-cms-pages',
            'admin.content.update' => 'edit-cms-pages',
            'admin.content.delete' => 'delete-cms-pages',
    
            'admin.social.index' => 'view-social-media',
            'admin.social.create' => 'add-social-media',
            'admin.social.store' => 'add-social-media',
            'admin.social.edit' => 'edit-social-media',
            'admin.social.update' => 'edit-social-media',
            'admin.social.delete' => 'delete-social-media',
    
            'admin.roles.index' => 'view-roles',
            'admin.roles.create' => 'add-roles',
            'admin.roles.store' => 'add-roles',
            'admin.roles.edit' => 'edit-roles',
            'admin.roles.update' => 'edit-roles',
            'admin.roles.delete' => 'delete-roles',
    
            'admin.permissions.index' => 'view-permissions',
            'admin.permissions.create' => 'add-permissions',
            'admin.permissions.store' => 'add-permissions',
    
            'admin.maintenance.index' => 'view-maintenance',
            'admin.maintenance.create' => 'add-maintenance',
            'admin.maintenance.store' => 'add-maintenance',
            'admin.maintenance.edit' => 'edit-maintenance',
            'admin.maintenance.update' => 'edit-maintenance',
            'admin.maintenance.delete' => 'delete-maintenance',
    
            'admin.settings.index' => 'view-general',
            'admin.settings.update' => 'edit-general',
            'admin.email.index' => 'view-email-config',
            'admin.email.update' => 'edit-email-config',
            'admin.personal.index' => 'view-personal-details',
            'admin.personal.update' => 'edit-personal-details',
            'admin.seo.index' => 'view-seo',
            'admin.seo.update' => 'edit-seo',
            'admin.contact.index' => 'view-contacts',
    
            'admin.templates.index' => 'view-email-templates',
            'admin.templates.update' => 'edit-email-templates',
    
            'admin.country.index' => 'view-countries',
            'admin.country.create' => 'add-countries',
            'admin.country.store' => 'add-countries',
            'admin.country.edit' => 'edit-countries',
            'admin.country.update' => 'edit-countries',
            'admin.country.delete' => 'delete-countries',
    
            'admin.backup.index' => 'view-backup',
            'admin.backup.store' => 'create-backup',
            'admin.backup.download' => 'edit-backup',

            'admin.ticket.index' => 'view-tickets',
            'admin.ticket.create' => 'add-tickets',
            'admin.ticket.store' => 'add-tickets',
            'admin.ticket.edit' => 'edit-tickets',
            'admin.ticket.update' => 'edit-tickets',
            'admin.ticket.delete' => 'delete-tickets',
            'admin.ticket.reply' => 'edit-tickets',
            'admin.ticket.reply.store' => 'edit-tickets',
        ];

        return $permissions[$routeName] ?? null;
    }
}