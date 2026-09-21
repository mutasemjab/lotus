<?php

namespace Database\Seeders;

use App\Models\MapCountry;
use App\Models\SectionHeader;
use App\Models\ShippingMode;
use App\Models\SiteStat;
use Illuminate\Database\Seeder;

/**
 * Initial content for the Stats band, World map and Shipping solutions sections.
 * Safe to re-run: each block only seeds when its table is empty, so it never
 * overwrites what was edited from the admin panel.
 */
class GlobalSectionsSeeder extends Seeder
{
    public function run(): void
    {
        $this->headers();
        $this->stats();
        $this->countries();
        $this->shipping();
    }

    private function headers(): void
    {
        SectionHeader::firstOrCreate(['section_key' => 'map'], [
            'eyebrow_en'  => 'Global reach',
            'eyebrow_ar'  => 'حضور عالمي',
            'title_en'    => 'Countries we work with',
            'title_ar'    => 'الدول التي نتعامل معها',
            'subtitle_en' => 'From our hubs in Jordan and Iraq, we move cargo to and from partners across Europe, the Gulf and Asia.',
            'subtitle_ar' => 'من مراكزنا في الأردن والعراق ننقل البضائع من وإلى شركائنا في أوروبا والخليج وآسيا.',
        ]);

        SectionHeader::firstOrCreate(['section_key' => 'shipping'], [
            'eyebrow_en'  => 'Shipping solutions',
            'eyebrow_ar'  => 'حلول الشحن',
            'title_en'    => 'Shipping Solutions',
            'title_ar'    => 'حلول الشحن',
            'subtitle_en' => 'Integrated solutions connecting Iraq and Jordan to global markets and ports through flexible land, sea and air routes.',
            'subtitle_ar' => 'حلول متكاملة تربط العراق والأردن بالأسواق والموانئ العالمية عبر مسارات برية وبحرية وجوية مرنة',
        ]);
    }

    private function stats(): void
    {
        if (SiteStat::exists()) {
            return;
        }

        // Placeholder figures — edit them in Admin › Statistics Band.
        $rows = [
            [15,    '+', 'Years of experience',      'سنة من الخبرة'],
            [12000, '+', 'Shipments cleared',        'شحنة تم تخليصها'],
            [15,    '+', 'Countries we work with',   'دولة نتعامل معها'],
            [3,     '',  'Routes: sea, air & land',  'مسارات: بحري وجوي وبري'],
        ];

        foreach ($rows as $i => [$value, $suffix, $en, $ar]) {
            SiteStat::create([
                'value' => $value, 'suffix' => $suffix,
                'label_en' => $en, 'label_ar' => $ar,
                'sort_order' => $i,
            ]);
        }
    }

    private function countries(): void
    {
        if (MapCountry::exists()) {
            return;
        }

        $presets = config('map_countries.presets');
        $codes   = ['jo', 'iq', 'sa', 'kw', 'ae', 'tr', 'eg', 'gb', 'nl', 'de', 'fr', 'es', 'it', 'in', 'cn'];
        $hubs    = ['jo', 'iq'];

        foreach ($codes as $i => $code) {
            [$en, $ar, $lat, $lon] = $presets[$code];
            MapCountry::create([
                'code' => $code, 'name_en' => $en, 'name_ar' => $ar,
                'latitude' => $lat, 'longitude' => $lon,
                'is_hub' => in_array($code, $hubs, true),
                'sort_order' => $i,
            ]);
        }
    }

    private function shipping(): void
    {
        if (ShippingMode::exists()) {
            return;
        }

        $modes = [
            [
                'icon' => 'sea',
                'tag'  => ['International container port', 'ميناء حاويات دولي'],
                'title' => ['Sea Freight', 'الشحن البحري'],
                'routes' => [
                    [['Global ports', 'الموانئ العالمية'], ['Umm Qasr', 'أم قصر']],
                    [['Aqaba', 'العقبة'],                  ['Traybil', 'طريبيل']],
                    [['Mersin', 'مرسين'],                  ['Ibrahim Al-Khalil / Rabia', 'إبراهيم الخليل / ربيعة']],
                ],
            ],
            [
                'icon' => 'air',
                'tag'  => ['Cargo aircraft at an international airport', 'طائرة شحن في مطار دولي'],
                'title' => ['Air Freight', 'الشحن الجوي'],
                'routes' => [
                    [['Baghdad International Airport', 'مطار بغداد الدولي']],
                    [['Queen Alia International Airport', 'مطار الملكة علياء الدولي']],
                    [['Queen Alia', 'الملكة علياء'], ['Traybil', 'طريبيل']],
                ],
            ],
            [
                'icon' => 'land',
                'tag'  => ['International road freight', 'شاحنات شحن بري دولي'],
                'title' => ['Land Freight', 'الشحن البري'],
                'routes' => [
                    [['Europe / UK', 'أوروبا / بريطانيا'], ['Iraq', 'العراق']],
                    [['Europe', 'أوروبا'], ['Traybil', 'طريبيل']],
                    [['Europe', 'أوروبا'], ['Ibrahim Al-Khalil / Rabia', 'إبراهيم الخليل / ربيعة']],
                    [['Europe & Türkiye', 'أوروبا وتركيا'], ['Jordan & the Gulf', 'الأردن والخليج'], true],
                    [['The Gulf', 'الخليج'], ['Arar', 'عرعر']],
                    [['Al-Walid crossing', 'منفذ الوليد']],
                ],
            ],
        ];

        foreach ($modes as $i => $m) {
            $mode = ShippingMode::create([
                'icon'       => $m['icon'],
                'tag_en'     => $m['tag'][0],   'tag_ar'   => $m['tag'][1],
                'title_en'   => $m['title'][0], 'title_ar' => $m['title'][1],
                'link'       => '#contact',
                'sort_order' => $i,
            ]);

            foreach ($m['routes'] as $j => $r) {
                $mode->routes()->create([
                    'from_en' => $r[0][0], 'from_ar' => $r[0][1],
                    'to_en'   => $r[1][0] ?? null, 'to_ar' => $r[1][1] ?? null,
                    'is_bidirectional' => $r[2] ?? false,
                    'sort_order' => $j,
                ]);
            }
        }
    }
}
