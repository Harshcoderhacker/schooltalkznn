<?php

namespace App\Main\Admin;

class SideMenu
{
    /**
     * List of side menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function menu()
    {
        if (env('SCHOOLTALKZ')) {
            return [
                'dashboard' => [
                    'icon' => 'home',
                    'route_name' => 'admindashboard',
                    'params' => [
                        'layout' => 'side-menu',
                    ],
                    'title' => 'Dashboard',
                ],
                'student' => [
                    'icon' => 'users',
                    'route_name' => 'adminstudent',
                    'params' => [
                        'layout' => 'side-menu',
                    ],
                    'title' => 'Students',
                ],
                'staff' => [
                    'icon' => 'user',
                    'route_name' => 'adminstaff',
                    'params' => [
                        'layout' => 'side-menu',
                    ],
                    'title' => 'Staffs',
                ],

                'report' => [
                    'icon' => 'flag',
                    'route_name' => 'adminreport',
                    'params' => [
                        'layout' => 'side-menu',
                    ],
                    'title' => 'Report',
                ],
                'feed' => [
                    'icon' => 'align-center',
                    'route_name' => 'adminfeedlatest',
                    'params' => [
                        'layout' => 'side-menu',
                    ],
                    'title' => 'School Talkz',
                ],
                'setting' => [
                    'icon' => 'settings',
                    'route_name' => 'adminsettings',
                    'params' => [
                        'layout' => 'side-menu',
                    ],
                    'title' => 'Settings',
                ],

            ];
        } else {
            return [
                'dashboard' => [
                    'icon' => 'home',
                    'route_name' => 'admindashboard',
                    'params' => [
                        'layout' => 'side-menu',
                    ],
                    'title' => 'Dashboard',
                ],
                'student' => [
                    'icon' => 'users',
                    'route_name' => 'adminstudent',
                    'params' => [
                        'layout' => 'side-menu',
                    ],
                    'title' => 'Students',
                ],
                'staff' => [
                    'icon' => 'user',
                    'route_name' => 'adminstaff',
                    'params' => [
                        'layout' => 'side-menu',
                    ],
                    'title' => 'Staffs',
                ],
                'fee' => [
                    'icon' => 'dollar-sign',
                    'route_name' => 'adminfee',
                    'params' => [
                        'layout' => 'side-menu',
                    ],
                    'title' => 'Fee',
                ],
                'exam' => [
                    'icon' => 'edit-3',
                    'route_name' => 'adminexam',
                    'params' => [
                        'layout' => 'side-menu',
                    ],
                    'title' => 'Exams',
                ],
                'homework' => [
                    'icon' => 'layers',
                    'route_name' => 'adminhomework',
                    'params' => [
                        'layout' => 'side-menu',
                    ],
                    'title' => 'Homeworks',
                ],
                // 'communication' => [
                //     'icon' => 'message-circle',
                //     'route_name' => 'admincommuication',
                //     'params' => [
                //         'layout' => 'side-menu',
                //     ],
                //     'title' => 'Communications',
                // ],
                // 'virtualclass' => [
                //     'icon' => 'airplay',
                //     'route_name' => 'adminvirtualclass',
                //     'params' => [
                //         'layout' => 'side-menu',
                //     ],
                //     'title' => 'Virtual Class',
                // ],
                'class' => [
                    'icon' => 'briefcase',
                    'route_name' => 'adminclass',
                    'params' => [
                        'layout' => 'side-menu',
                    ],
                    'title' => 'Class',
                ],
                'materials' => [
                    'icon' => 'package',
                    'route_name' => 'adminmaterials',
                    'params' => [
                        'layout' => 'side-menu',
                    ],
                    'title' => 'Materials',
                ],
                'report' => [
                    'icon' => 'flag',
                    'route_name' => 'adminreport',
                    'params' => [
                        'layout' => 'side-menu',
                    ],
                    'title' => 'Report',
                ],
                'feed' => [
                    'icon' => 'align-center',
                    'route_name' => 'adminfeedlatest',
                    'params' => [
                        'layout' => 'side-menu',
                    ],
                    'title' => 'School Talkz',
                ],
                'setting' => [
                    'icon' => 'settings',
                    'route_name' => 'adminsettings',
                    'params' => [
                        'layout' => 'side-menu',
                    ],
                    'title' => 'Settings',
                ],
                'lessonplanner' => [
                    'icon' => 'book-open',
                    'route_name' => 'adminlessonplanner',
                    'params' => [
                        'layout' => 'side-menu',
                    ],
                    'title' => 'Lesson Planner',
                ],
            ];
        }

    }
}
