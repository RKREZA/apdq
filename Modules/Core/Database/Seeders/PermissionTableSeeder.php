<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\File;
use Modules\Transportation\Entities\Transportation;
use Modules\User\Entities\Permission;
use Modules\User\Entities\PermissionGroup;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Profile
            $group = PermissionGroup::create([
                'name' => 'profile',
                'display_name' => 'Profile',
            ]);
            Permission::create([
                'name' => 'profile-index',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'profile-update',
                'permissiongroup_id' => $group->id,
            ]);
        // Profile End

        //User
            $group = PermissionGroup::create([
                'name' => 'user',
                'display_name' => 'User',
            ]);
            Permission::create([
                'name' => 'user-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'user-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'user-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'user-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //User End

        //User Role
            $group = PermissionGroup::create([
                'name' => 'role',
                'display_name' => 'User Role',
            ]);
            Permission::create([
                'name' => 'role-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'role-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'role-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'role-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //User Role End

        //User Permission
            $group = PermissionGroup::create([
                'name' => 'permission',
                'display_name' => 'Permission',
            ]);
            Permission::create([
                'name' => 'permission-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'permission-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'permission-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'permission-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //User Permission End

        //Permission Group
            $group = PermissionGroup::create([
                'name' => 'permissiongroup',
                'display_name' => 'Permission Group',
            ]);
            Permission::create([
                'name' => 'permissiongroup-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'permissiongroup-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'permissiongroup-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'permissiongroup-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //Permission Group End

        //Admin Setting
            $group = PermissionGroup::create([
                'name' => 'adminsetting',
                'display_name' => 'Admin Setting',
            ]);
            Permission::create([
                'name' => 'adminsetting-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'file-manager',
                'permissiongroup_id' => $group->id,
            ]);
        //Admin Setting End

        //Backup
            $group = PermissionGroup::create([
                'name' => 'backup',
                'display_name' => 'Backup',
            ]);
            Permission::create([
                'name' => 'backup-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'backup-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'backup-clean',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'backup-monitor',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'backup-delete',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'backup-download',
                'permissiongroup_id' => $group->id,
            ]);
        //Backup End

        //Language
            $group = PermissionGroup::create([
                'name' => 'language',
                'display_name' => 'Language',
            ]);
            Permission::create([
                'name' => 'language-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'language-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'language-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'language-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //Language End

        //Frontend Manager
            $group = PermissionGroup::create([
                'name' => 'frontendsetting',
                'display_name' => 'Frontend Setting',
            ]);
            Permission::create([
                'name' => 'frontendsetting-list',
                'permissiongroup_id' => $group->id,
            ]);
        //Frontend Manager End

        // //Slider
        //     $group = PermissionGroup::create([
        //         'name' => 'slider',
        //         'display_name' => 'Slider',
        //     ]);
        //     Permission::create([
        //         'name' => 'slider-list',
        //         'permissiongroup_id' => $group->id,
        //     ]);
        //     Permission::create([
        //         'name' => 'slider-create',
        //         'permissiongroup_id' => $group->id,
        //     ]);
        //     Permission::create([
        //         'name' => 'slider-edit',
        //         'permissiongroup_id' => $group->id,
        //     ]);
        //     Permission::create([
        //         'name' => 'slider-delete',
        //         'permissiongroup_id' => $group->id,
        //     ]);
        // //Slider End

        // //Slider Category
        //     $group = PermissionGroup::create([
        //         'name' => 'slidercategory',
        //         'display_name' => 'slider Category',
        //     ]);
        //     Permission::create([
        //         'name' => 'slidercategory-list',
        //         'permissiongroup_id' => $group->id,
        //     ]);
        //     Permission::create([
        //         'name' => 'slidercategory-create',
        //         'permissiongroup_id' => $group->id,
        //     ]);
        //     Permission::create([
        //         'name' => 'slidercategory-edit',
        //         'permissiongroup_id' => $group->id,
        //     ]);
        //     Permission::create([
        //         'name' => 'slidercategory-delete',
        //         'permissiongroup_id' => $group->id,
        //     ]);
        // //Slider Category End

        //CMS
            $group = PermissionGroup::create([
                'name' => 'cms',
                'display_name' => 'CMS',
            ]);
            Permission::create([
                'name' => 'cms-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'cms-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'cms-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'cms-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //CMS End

        //CMS Category
            $group = PermissionGroup::create([
                'name' => 'cmscategory',
                'display_name' => 'CMS Category',
            ]);
            Permission::create([
                'name' => 'cmscategory-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'cmscategory-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'cmscategory-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'cmscategory-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //CMS Category End

        //File Manager
            $group = PermissionGroup::create([
                'name' => 'filemanager',
                'display_name' => 'File Manager',
            ]);
            Permission::create([
                'name' => 'filemanager-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'filemanager-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'filemanager-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'filemanager-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //File Manager End

        //Faq
            $group = PermissionGroup::create([
                'name' => 'faq',
                'display_name' => 'Faq',
            ]);
            Permission::create([
                'name' => 'faq-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'faq-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'faq-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'faq-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //Faq End

        //Faq Category
            $group = PermissionGroup::create([
                'name' => 'faqcategory',
                'display_name' => 'Faq Category',
            ]);
            Permission::create([
                'name' => 'faqcategory-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'faqcategory-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'faqcategory-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'faqcategory-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //Faq Category End

        //Feedback
            $group = PermissionGroup::create([
                'name' => 'feedback',
                'display_name' => 'Feedback',
            ]);
            Permission::create([
                'name' => 'feedback-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'feedback-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'feedback-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'feedback-view',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'feedback-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //Feedback End

        //Feedback Category
            $group = PermissionGroup::create([
                'name' => 'feedbackcategory',
                'display_name' => 'Feedback Category',
            ]);
            Permission::create([
                'name' => 'feedbackcategory-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'feedbackcategory-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'feedbackcategory-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'feedbackcategory-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //Feedback Category End

        //Announcement
            $group = PermissionGroup::create([
                'name' => 'announcement',
                'display_name' => 'Announcement',
            ]);
            Permission::create([
                'name' => 'announcement-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'announcement-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'announcement-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'announcement-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //Announcement End

        //Video
            $group = PermissionGroup::create([
                'name' => 'video',
                'display_name' => 'Video',
            ]);
            Permission::create([
                'name' => 'video-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'video-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'video-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'video-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //Video End

        //Video Category
            $group = PermissionGroup::create([
                'name' => 'videocategory',
                'display_name' => 'Video Category',
            ]);
            Permission::create([
                'name' => 'videocategory-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'videocategory-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'videocategory-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'videocategory-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //Video Category End

        //Video Subcategory
            $group = PermissionGroup::create([
                'name' => 'videosubcategory',
                'display_name' => 'Video Sub Category',
            ]);
            Permission::create([
                'name' => 'videosubcategory-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'videosubcategory-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'videosubcategory-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'videosubcategory-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //Video Category End

        //Video Playlist
            $group = PermissionGroup::create([
                'name' => 'videoplaylist',
                'display_name' => 'Video Playlist',
            ]);
            Permission::create([
                'name' => 'videoplaylist-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'videoplaylist-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'videoplaylist-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'videoplaylist-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //Video Playlist End

        //Post
            $group = PermissionGroup::create([
                'name' => 'post',
                'display_name' => 'Post',
            ]);
            Permission::create([
                'name' => 'post-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'post-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'post-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'post-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //Post End

        //Post Category
            $group = PermissionGroup::create([
                'name' => 'postcategory',
                'display_name' => 'Post Category',
            ]);
            Permission::create([
                'name' => 'postcategory-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'postcategory-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'postcategory-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'postcategory-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //Post Category End

        //Post Sub Category
            $group = PermissionGroup::create([
                'name' => 'postsubcategory',
                'display_name' => 'Post Sub category',
            ]);
            Permission::create([
                'name' => 'postsubcategory-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'postsubcategory-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'postsubcategory-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'postsubcategory-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //Post Sub Category End

        //Live
            $group = PermissionGroup::create([
                'name' => 'live',
                'display_name' => 'Live',
            ]);
            Permission::create([
                'name' => 'live-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'live-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'live-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'live-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //Live End

        //Subscription
            $group = PermissionGroup::create([
                'name' => 'subscription',
                'display_name' => 'Subscription',
            ]);
            Permission::create([
                'name' => 'subscription-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'subscription-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'subscription-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'subscription-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //Subscription End

        //Newsletter
            $group = PermissionGroup::create([
                'name' => 'newsletter',
                'display_name' => 'Newsletter',
            ]);
            Permission::create([
                'name' => 'newsletter-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'newsletter-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'newsletter-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'newsletter-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //Newsletter End

        //Newsletter Category
            $group = PermissionGroup::create([
                'name' => 'newslettercategory',
                'display_name' => 'Newsletter Category',
            ]);
            Permission::create([
                'name' => 'newslettercategory-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'newslettercategory-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'newslettercategory-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'newslettercategory-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //Newsletter End

        //Payment Gateway
            $group = PermissionGroup::create([
                'name' => 'paymentgateway',
                'display_name' => 'Payment Gateway',
            ]);
            Permission::create([
                'name' => 'paymentgateway-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'paymentgateway-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'paymentgateway-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'paymentgateway-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //Payment End

        //Transaction
            $group = PermissionGroup::create([
                'name' => 'transaction',
                'display_name' => 'Transaction',
            ]);
            Permission::create([
                'name' => 'transaction-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'transaction-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'transaction-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'transaction-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //Transaction End

        //Page
            $group = PermissionGroup::create([
                'name' => 'page',
                'display_name' => 'Page',
            ]);
            Permission::create([
                'name' => 'page-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'page-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'page-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'page-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //Page End

        //Page Category
            $group = PermissionGroup::create([
                'name' => 'pagecategory',
                'display_name' => 'Page Category',
            ]);
            Permission::create([
                'name' => 'pagecategory-list',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'pagecategory-create',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'pagecategory-edit',
                'permissiongroup_id' => $group->id,
            ]);
            Permission::create([
                'name' => 'pagecategory-delete',
                'permissiongroup_id' => $group->id,
            ]);
        //Page Category End

    }
}
