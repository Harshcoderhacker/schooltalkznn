<?php

namespace App\Main\Staff;

class StaffSideMenu
{
    /**
     * List of side menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function menu()
    {
        return [
            'dashboard' => [
                'icon' => 'home',
                'route_name' => 'staffdashboard',
                'params' => [
                    'layout' => 'side-menu',
                ],
                'title' => 'Dashboard',
            ],
            'student' => [
                'icon' => 'users',
                'route_name' => 'staffstudentindex',
                'params' => [
                    'layout' => 'side-menu',
                ],
                'title' => 'Student',
            ],
            'classroutine' => [
                'icon' => 'trello',
                'route_name' => 'staffmyclassroutine',
                'params' => [
                    'layout' => 'side-menu',
                ],
                'title' => 'Class Routine',
            ],
            'attendance' => [
                'icon' => 'user-check',
                'route_name' => 'staffattendance',
                'params' => [
                    'layout' => 'side-menu',
                ],
                'title' => 'Attendance',
            ],
            'staffreport' => [
                'icon' => 'flag',
                'route_name' => 'staffreport',
                'params' => [
                    'layout' => 'side-menu',
                ],
                'title' => 'Reports',
            ],
            'exams' => [
                'icon' => 'edit-3',
                'route_name' => 'staffexam',
                'params' => [
                    'layout' => 'side-menu',
                ],
                'title' => 'Exams',
            ],
            'homawork' => [
                'icon' => 'layers',
                'route_name' => 'staffhomework',
                'params' => [
                    'layout' => 'side-menu',
                ],
                'title' => 'Homework',
            ],
            // 'communication' => [
            //     'icon' => 'message-circle',
            //     'route_name' => 'staffcommunication',
            //     'params' => [
            //         'layout' => 'side-menu',
            //     ],
            //     'title' => 'Communication',
            // ],
            // 'virtualclass' => [
            //     'icon' => 'airplay',
            //     'route_name' => 'staffvirtualclass',
            //     'params' => [
            //         'layout' => 'side-menu',
            //     ],
            //     'title' => 'Virtual class',
            // ],
            'class' => [
                'icon' => 'briefcase',
                'route_name' => 'staffclass',
                'params' => [
                    'layout' => 'side-menu',
                ],
                'title' => 'Class',
            ],
            'materials' => [
                'icon' => 'package',
                'route_name' => 'staffmaterials',
                'params' => [
                    'layout' => 'side-menu',
                ],
                'title' => 'Materials',
            ],
            'feed' => [
                'icon' => 'align-center',
                'route_name' => 'stafffeedlatest',
                'params' => [
                    'layout' => 'side-menu',
                ],
                'title' => 'School Talkz',
            ],
            'settings' => [
                'icon' => 'settings',
                'params' => [
                    'layout' => 'side-menu',
                ],
                'title' => 'Settings',
            ],
        ];
    }
}
