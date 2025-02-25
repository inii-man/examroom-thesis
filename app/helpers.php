<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

if (!function_exists('isActiveMenuItem')) {
    /**
     * Check if a menu item should be active based on the route.
     *
     * @param string $route
     * @return string
     */
    function isActiveMenuItem($route)
    {
        return request()->routeIs($route . '*') ? 'active' : '';
    }
}

if (!function_exists('isActiveSubMenu')) {
    /**
     * Check if any sub-menu item is active.
     *
     * @param array $subRoutes
     * @return string
     */
    function isActiveSubMenu($subRoutes)
    {
        foreach ($subRoutes as $subRoute) {
            if (request()->routeIs($subRoute . '*')) {
                return 'active open';
            }
        }
        return '';
    }
}

if (!function_exists('isMenuHeaderVisible')) {
    /**
     * Determine if a menu header should be visible.
     *
     * @param array $permissions
     * @return bool
     */
    function isMenuHeaderVisible($permissions = [])
    {
        return empty($permissions) || auth()->user()->canany($permissions);
    }
}

if (!function_exists('profilePicture')) {
    /**
     * Get the profile picture of a user.
     *
     * @param \App\Models\User $user
     * @return string
     */
    function profilePicture($user = null)
    {
        $user = $user ?? auth()->user();
        $path = 'storage/profile/' . $user->profile_pic;
        if (($user->profile_pic != null) && File::exists(public_path($path))) {
            return asset($path);
        } else {
            $colors = [
                ['color' => '7F9CF5', 'background' => 'EBF4FF'],
                ['color' => 'F472B6', 'background' => 'FDE8F0'],
                ['color' => 'FBBF24', 'background' => 'FEF3C7'],
                ['color' => '34D399', 'background' => 'ECFDF5'],
                ['color' => 'F87171', 'background' => 'FEF2F2'],
                ['color' => '60A5FA', 'background' => 'EFF6FF'],
                ['color' => '818CF8', 'background' => 'EEF2FF'],
                ['color' => 'F472B6', 'background' => 'FDE8F0'],
                ['color' => 'FBBF24', 'background' => 'FEF3C7'],
                ['color' => '34D399', 'background' => 'ECFDF5'],
            ];
            $color = $colors[rand(0, count($colors) - 1)];
            return 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&color=' . $color['color'] . '&background=' . $color['background'];
            // alternative
            // return url('/assets/img/avatars/blank.png');
            // return asset('/assets/img/front-pages/icons/user.png');
        }
    }
}

if (!function_exists('app_config')) {
    /**
     * Get the value of a configuration key.
     *
     * @param string $key
     * @return string
     */
    function app_config($key)
    {
        $config = [
            'app_home' => 'Dashboard',
            'app_name' => '1.0.0 | Techno Project Template',
            'app_logo' => '/assets/img/favicon/favicon.ico',
            'sidebar_name' => 'Techno',
            'sidebar_logo' => '/assets/svg/icons/vuexy-sidebar.svg',
            'login_bg' => '/assets/img/backgrounds/techno.png',
            'login_bg_style' => 'height: auto; width: 100%;',
            'primary_hex' => '#7367f0',
            'show_dummy' => "true",
        ];
        $stored_config = App\Models\Config::all()->pluck('config_value', 'config_name');
        $config = array_merge($config, $stored_config->toArray());

        $config['primary_color'] = hex2hsl($config['primary_hex']);
        $config['primary_color_label'] = hex2hsl($config['primary_hex'], -15, 20);
        $config['primary_color_hover'] = hex2hsl($config['primary_hex'], -15);
        $config['primary_color_shadow'] = hex2hsl($config['primary_hex'], -15, 50);
        // dd($config);

        return $config[$key] ?? "";
    }
}

if (!function_exists('hex2hsl')) {
    /**
     * Convert a hex color to hsl.
     *
     * @param string|array $RGB hex color value
     * @param int $ladj lightness adjustment
     * @param int $oadj opacity adjustment
     * @return string
     */

    function hex2hsl($RGB, $ladj = 0, $oadj = 0)
    {
        //have we got an RGB array or a string of hex RGB values (assume it is valid!)
        if (!is_array($RGB)) {
            $hexstr = ltrim($RGB, '#');
            if (strlen($hexstr) == 3) {
                $hexstr = $hexstr[0] . $hexstr[0] . $hexstr[1] . $hexstr[1] . $hexstr[2] . $hexstr[2];
            }
            $R = hexdec($hexstr[0] . $hexstr[1]);
            $G = hexdec($hexstr[2] . $hexstr[3]);
            $B = hexdec($hexstr[4] . $hexstr[5]);
            $RGB = array($R, $G, $B);
        }
        // scale the RGB values to 0 to 1 (percentages)
        $r = $RGB[0] / 255;
        $g = $RGB[1] / 255;
        $b = $RGB[2] / 255;
        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        // lightness calculation. 0 to 1 value, scale to 0 to 100% at end
        $l = ($max + $min) / 2;

        // saturation calculation. Also 0 to 1, scale to percent at end.
        $d = $max - $min;
        if ($d == 0) {
            // achromatic (grey) so hue and saturation both zero
            $h = $s = 0;
        } else {
            $s = $d / (1 - abs((2 * $l) - 1));
            // hue (if not grey) This is being calculated directly in degrees (0 to 360)
            switch ($max) {
                case $r:
                    $h = 60 * fmod((($g - $b) / $d), 6);
                    if ($b > $g) { //will have given a negative value for $h
                        $h += 360;
                    }
                    break;
                case $g:
                    $h = 60 * (($b - $r) / $d + 2);
                    break;
                case $b:
                    $h = 60 * (($r - $g) / $d + 4);
                    break;
            } //end switch
        } //end else 
        // make any lightness adjustment required
        if ($ladj > 0) {
            $l += (1 - $l) * $ladj / 100;
        } elseif ($ladj < 0) {
            $l += $l * $ladj / 100;
        }

        //put the values in an array and scale the saturation and lightness to be percentages
        $hsl = array(round($h), round($s * 100), round($l * 100));
        //we could return that, but lets build a CSS compatible string and return that instead
        $hslstr = 'hsl(' . $hsl[0] . ',' . $hsl[1] . '%,' . $hsl[2] . '%)';
        //make adjust opacity and turn into hsla
        if ($oadj != 0) {
            $hslstr = 'hsla(' . $hsl[0] . ',' . $hsl[1] . '%,' . $hsl[2] . '%,' . ($oadj / 100) . ')';
        }
        return $hslstr;
    }
}

if (!function_exists('isSuperAdmin')) {
    /**
     * Check if the authenticated user is a super admin.
     *
     * @return bool
     */
    function isSuperAdmin()
    {
        return auth()->user()->hasRole('Super Admin');
    }
}

if (!function_exists('uploadFile')) {
    /**
     * Upload a file to the storage.
     * if old file exists, delete it.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $folder
     * @param string $oldFile
     * @return string
     */
    function uploadFile($requestFile, $folderName, $oldFile = null)
    {
        try {
            if ($oldFile) {
                if (Storage::disk('public')->exists($oldFile)) {
                    Storage::disk('public')->delete($oldFile);
                }
            }
            return $requestFile->store($folderName, 'public');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}


if (!function_exists('indonesian_date_format')) {
    function indonesian_date_format($date)
    {
        return Carbon::parse($date)->locale('id')->isoFormat('D MMMM YYYY');
    }
}

// if (!function_exists('terbilang')) {
//     function terbilang($x)
//     {
//         $x = abs($x);
//         $angka = array(
//             "",
//             "satu",
//             "dua",
//             "tiga",
//             "empat",
//             "lima",
//             "enam",
//             "tujuh",
//             "delapan",
//             "sembilan",
//             "sepuluh",
//             "sebelas"
//         );
//         $temp = "";
//         if ($x < 12) {
//             $temp = " " . $angka[$x];
//         } else if ($x < 20) {
//             $temp = terbilang($x - 10) . " belas";
//         } else if ($x < 100) {
//             $temp = terbilang($x / 10) . " puluh" . terbilang($x % 10);
//         } else if ($x < 200) {
//             $temp = " seratus" . terbilang($x - 100);
//         } else if ($x < 1000) {
//             $temp = terbilang($x / 100) . " ratus" . terbilang($x % 100);
//         } else if ($x < 2000) {
//             $temp = " seribu" . terbilang($x - 1000);
//         } else if ($x < 1000000) {
//             $temp = terbilang($x / 1000) . " ribu" . terbilang($x % 1000);
//         } else if ($x < 1000000000) {
//             $temp = terbilang($x / 1000000) . " juta" . terbilang($x % 1000000);
//         } else if ($x < 1000000000000) {
//             $temp = terbilang($x / 1000000000) . " milyar" . terbilang(fmod($x, 1000000000));
//         } else if ($x < 1000000000000000) {
//             $temp = terbilang($x / 1000000000000) . " trilyun" . terbilang(fmod($x, 1000000000000));
//         }
//         return $temp;
//     }
// }

// if (!function_exists('check_minio')) {
//     function check_minio($data, $file = '')
//     {
//         try {
//             $exists = Storage::disk('s3')->exists($data);
//             if ($exists) $file = Storage::disk('s3')->temporaryUrl($data, now()->addMinutes(5));
//         } catch (\Exception $e) {
//             $file;
//         }
//         return $file;
//     }
// }
