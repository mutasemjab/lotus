<?php

/**
 * Country presets for the "Countries we work with" map (admin picker) and
 * the map bounds. The bounds MUST match the ones used to generate
 * assets_front/img/world-dots.svg.
 */
return [

    'bounds' => ['lon_min' => -25, 'lon_max' => 135, 'lat_max' => 66, 'lat_min' => -4],

    // code => [name_en, name_ar, lat, lon]
    'presets' => [
        'jo' => ['Jordan', 'الأردن', 31.0, 36.5],
        'iq' => ['Iraq', 'العراق', 33.0, 44.0],
        'sa' => ['Saudi Arabia', 'السعودية', 24.5, 45.0],
        'kw' => ['Kuwait', 'الكويت', 29.3, 47.6],
        'ae' => ['UAE', 'الإمارات', 24.3, 54.3],
        'qa' => ['Qatar', 'قطر', 25.3, 51.2],
        'bh' => ['Bahrain', 'البحرين', 26.0, 50.55],
        'om' => ['Oman', 'عُمان', 21.5, 56.0],
        'ye' => ['Yemen', 'اليمن', 15.6, 48.0],
        'sy' => ['Syria', 'سوريا', 35.0, 38.5],
        'lb' => ['Lebanon', 'لبنان', 33.9, 35.9],
        'ps' => ['Palestine', 'فلسطين', 31.9, 35.2],
        'ir' => ['Iran', 'إيران', 32.5, 53.5],
        'tr' => ['Türkiye', 'تركيا', 39.0, 35.2],
        'eg' => ['Egypt', 'مصر', 26.5, 30.0],
        'ly' => ['Libya', 'ليبيا', 27.0, 17.5],
        'tn' => ['Tunisia', 'تونس', 34.0, 9.5],
        'dz' => ['Algeria', 'الجزائر', 28.0, 2.6],
        'ma' => ['Morocco', 'المغرب', 31.8, -7.1],
        'sd' => ['Sudan', 'السودان', 15.5, 30.0],
        'et' => ['Ethiopia', 'إثيوبيا', 9.1, 40.5],
        'gb' => ['United Kingdom', 'بريطانيا', 53.0, -1.8],
        'ie' => ['Ireland', 'أيرلندا', 53.2, -8.0],
        'fr' => ['France', 'فرنسا', 46.6, 2.4],
        'es' => ['Spain', 'إسبانيا', 40.0, -3.5],
        'pt' => ['Portugal', 'البرتغال', 39.6, -8.0],
        'it' => ['Italy', 'إيطاليا', 42.8, 12.5],
        'de' => ['Germany', 'ألمانيا', 51.0, 10.3],
        'nl' => ['Netherlands', 'هولندا', 52.2, 5.4],
        'be' => ['Belgium', 'بلجيكا', 50.6, 4.6],
        'ch' => ['Switzerland', 'سويسرا', 46.8, 8.2],
        'at' => ['Austria', 'النمسا', 47.6, 14.1],
        'se' => ['Sweden', 'السويد', 62.0, 15.0],
        'pl' => ['Poland', 'بولندا', 52.0, 19.4],
        'ro' => ['Romania', 'رومانيا', 45.9, 25.0],
        'bg' => ['Bulgaria', 'بلغاريا', 42.7, 25.5],
        'gr' => ['Greece', 'اليونان', 39.0, 22.0],
        'ua' => ['Ukraine', 'أوكرانيا', 49.0, 31.4],
        'ru' => ['Russia', 'روسيا', 58.0, 40.0],
        'ge' => ['Georgia', 'جورجيا', 42.3, 43.4],
        'az' => ['Azerbaijan', 'أذربيجان', 40.3, 47.7],
        'kz' => ['Kazakhstan', 'كازاخستان', 48.0, 67.0],
        'pk' => ['Pakistan', 'باكستان', 30.0, 69.3],
        'in' => ['India', 'الهند', 22.0, 79.0],
        'bd' => ['Bangladesh', 'بنغلاديش', 23.7, 90.3],
        'lk' => ['Sri Lanka', 'سريلانكا', 7.8, 80.7],
        'cn' => ['China', 'الصين', 35.5, 103.5],
        'kr' => ['South Korea', 'كوريا الجنوبية', 36.5, 127.8],
        'th' => ['Thailand', 'تايلاند', 15.0, 101.0],
        'vn' => ['Vietnam', 'فيتنام', 15.0, 108.0],
        'my' => ['Malaysia', 'ماليزيا', 4.2, 102.0],
    ],
];
