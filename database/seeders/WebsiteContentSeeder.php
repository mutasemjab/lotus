<?php

namespace Database\Seeders;

use App\Models\AboutSection;
use App\Models\AboutStat;
use App\Models\ContactLocation;
use App\Models\ContactPhone;
use App\Models\HeroSection;
use App\Models\MarqueeItem;
use App\Models\ProcessStep;
use App\Models\SectionHeader;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\TrustItem;
use Illuminate\Database\Seeder;

class WebsiteContentSeeder extends Seeder
{
    public function run(): void
    {
        // Site Settings
        SiteSetting::set('whatsapp_number', '962785171895');
        SiteSetting::set('whatsapp_display', '0785171895');

        // Hero Section
        HeroSection::updateOrCreate(['id' => 1], [
            'kicker_en' => 'Licensed Customs Clearance — Amman, Jordan',
            'kicker_ar' => 'تخليص جمركي مرخّص — عمّان، الأردن',
            'title_en'  => "Your cargo crosses\nthe border, we handle\nevery step and stamp",
            'title_ar'  => "بضاعتك تعبر الحدود\ونحن نتولى\nكل خطوة وختم",
            'lead_en'   => 'AL-LOTUS manages the customs clearance journey for your sea, land and air shipments from arrival to release — precise paperwork and a fast, transparent turnaround.',
            'lead_ar'   => 'تتولى شركة اللوتس إدارة رحلة التخليص الجمركي لشحناتك البحرية والبرية والجوية من الوصول حتى التسليم — توثيق دقيق وإنجاز سريع وشفاف.',
            'btn1_text_en' => 'Contact the Office',
            'btn1_text_ar' => 'تواصل مع المكتب',
            'btn1_link'    => '#contact',
            'btn2_text_en' => 'See Our Services',
            'btn2_text_ar' => 'اطّلع على خدماتنا',
            'btn2_link'    => '#services',
        ]);

        // Marquee Items
        MarqueeItem::truncate();
        $marqueeItems = [
            ['text_en' => 'Sea, land & air customs clearance', 'text_ar' => 'تخليص جمركي بحري وبري وجوي', 'sort_order' => 1],
            ['text_en' => 'Daily follow-up on every shipment file', 'text_ar' => 'متابعة يومية لكل ملف شحن', 'sort_order' => 2],
            ['text_en' => 'Field experience across ports & border crossings', 'text_ar' => 'خبرة ميدانية في الموانئ والمنافذ الحدودية', 'sort_order' => 3],
            ['text_en' => 'An operations team you can reach directly', 'text_ar' => 'فريق عمليات يمكنك التواصل معه مباشرة', 'sort_order' => 4],
        ];
        foreach ($marqueeItems as $item) {
            MarqueeItem::create(array_merge($item, ['is_active' => true]));
        }

        // About Section
        AboutSection::updateOrCreate(['id' => 1], [
            'eyebrow_en'    => 'About Us',
            'eyebrow_ar'    => 'من نحن',
            'title_en'      => 'Hands-on knowledge of procedure, a direct line to every client',
            'title_ar'      => 'معرفة عملية بالإجراءات وتواصل مباشر مع كل عميل',
            'paragraph1_en' => 'AL-LOTUS was built to be the link between cargo owners and customs authorities. We follow the file from the moment a shipment reaches the port or border crossing — through classification and inspection — to release and handover.',
            'paragraph1_ar' => 'بُنيت شركة اللوتس لتكون الحلقة الرابطة بين أصحاب البضائع والجمارك. نتابع الملف من لحظة وصول الشحنة إلى الميناء أو المعبر الحدودي — مروراً بالتصنيف والفحص — حتى التسليم.',
            'paragraph2_en' => 'We handle commercial and industrial shipments of every size, and keep clients informed at each step — no surprises in fees, no delays hidden in the paperwork.',
            'paragraph2_ar' => 'نتعامل مع الشحنات التجارية والصناعية بكل أحجامها، ونُبقي العملاء على اطلاع في كل خطوة — لا مفاجآت في الرسوم، ولا تأخيرات مخفية في الأوراق.',
            'badge_number'  => '+15',
            'badge_text_en' => 'combined years of team experience',
            'badge_text_ar' => 'سنة خبرة مجتمعة لفريق العمل',
        ]);

        // About Stats
        AboutStat::truncate();
        $stats = [
            ['value' => '3',    'label_en' => 'Clearance routes: sea, land, air', 'label_ar' => 'مسارات تخليص: بحري وبري وجوي', 'sort_order' => 1],
            ['value' => '211',  'label_en' => 'Our office: Al Bassem Complex, Floor 2', 'label_ar' => 'مكتبنا: مجمع الباسم، الطابق الثاني', 'sort_order' => 2],
            ['value' => '24/7', 'label_en' => 'Follow-up on urgent shipments', 'label_ar' => 'متابعة الشحنات العاجلة', 'sort_order' => 3],
        ];
        foreach ($stats as $stat) {
            AboutStat::create($stat);
        }

        // Section Headers
        $headers = [
            [
                'section_key' => 'services',
                'eyebrow_en'  => 'Our Services',
                'eyebrow_ar'  => 'خدماتنا',
                'title_en'    => 'Five work tracks, one goal: a clean release for your cargo',
                'title_ar'    => 'خمسة مسارات عمل، هدف واحد: تخليص نظيف لبضاعتك',
                'subtitle_en' => 'Every shipment has its own path — we build the paperwork and procedure around your cargo and its destination, not the other way around.',
                'subtitle_ar' => 'لكل شحنة مسارها الخاص — نبني الأوراق والإجراءات حول بضاعتك ووجهتها، لا العكس.',
            ],
            [
                'section_key' => 'process',
                'eyebrow_en'  => 'Our Process',
                'eyebrow_ar'  => 'آلية عملنا',
                'title_en'    => 'From paperwork to delivery, five fixed steps',
                'title_ar'    => 'من الأوراق حتى التسليم، خمس خطوات ثابتة',
                'subtitle_en' => 'The same sequence for every shipment, regardless of size or destination.',
                'subtitle_ar' => 'التسلسل ذاته لكل شحنة، بصرف النظر عن الحجم أو الوجهة.',
            ],
            [
                'section_key' => 'trust',
                'eyebrow_en'  => '',
                'eyebrow_ar'  => '',
                'title_en'    => '',
                'title_ar'    => '',
                'subtitle_en' => '',
                'subtitle_ar' => '',
            ],
            [
                'section_key' => 'team',
                'eyebrow_en'  => 'Leadership',
                'eyebrow_ar'  => 'القيادة',
                'title_en'    => 'Every file has a name and a number behind it',
                'title_ar'    => 'كل ملف وراءه اسم ورقم',
                'subtitle_en' => 'Reach the person responsible for your file directly — no internal transfers.',
                'subtitle_ar' => 'تواصل مباشرة مع الشخص المسؤول عن ملفك — دون تحويلات داخلية.',
            ],
            [
                'section_key' => 'contact',
                'eyebrow_en'  => 'Get in Touch',
                'eyebrow_ar'  => 'تواصل معنا',
                'title_en'    => 'Ready to take on your shipment file today',
                'title_ar'    => 'مستعدون لاستلام ملف شحنتك اليوم',
                'subtitle_en' => 'Call the office directly, or reach the right person for your request.',
                'subtitle_ar' => 'اتصل بالمكتب مباشرة، أو تواصل مع الشخص المناسب لطلبك.',
            ],
        ];
        foreach ($headers as $header) {
            SectionHeader::updateOrCreate(['section_key' => $header['section_key']], $header);
        }

        // Services
        Service::truncate();
        $services = [
            ['number' => '01', 'letter' => 'M', 'title_en' => 'Sea Customs Clearance', 'title_ar' => 'تخليص جمركي بحري', 'description_en' => 'Following containers and goods arriving through Jordan\'s ports, from unloading to release, coordinated directly with shipping lines and customs.', 'description_ar' => 'متابعة الحاويات والبضائع الواردة عبر موانئ الأردن، من التفريغ حتى التسليم، بالتنسيق المباشر مع شركات الشحن والجمارك.', 'sort_order' => 1],
            ['number' => '02', 'letter' => 'R', 'title_en' => 'Land Border Clearance', 'title_ar' => 'تخليص جمركي بري', 'description_en' => 'Handling paperwork for shipments crossing land borders, with on-site follow-up that keeps truck waiting times to a minimum.', 'description_ar' => 'معالجة أوراق الشحنات العابرة للحدود البرية مع متابعة ميدانية تُقلل أوقات انتظار الشاحنات إلى أدنى حد.', 'sort_order' => 2],
            ['number' => '03', 'letter' => 'T', 'title_en' => 'Air Freight Clearance', 'title_ar' => 'تخليص شحن جوي', 'description_en' => 'Fast-tracked procedures for urgent, time-sensitive shipments arriving by air, with live follow-up on every document.', 'description_ar' => 'إجراءات مُعجَّلة للشحنات العاجلة والحساسة للوقت الواردة جواً، مع متابعة فورية لكل وثيقة.', 'sort_order' => 3],
            ['number' => '04', 'letter' => 'Y', 'title_en' => 'Customs Classification & Valuation', 'title_ar' => 'تصنيف وتقييم جمركي', 'description_en' => 'Reviewing tariff codes and duties owed in advance, to avoid disputes or delays during inspection.', 'description_ar' => 'مراجعة الرموز الجمركية والرسوم المستحقة مسبقاً، لتفادي النزاعات والتأخيرات أثناء الفحص.', 'sort_order' => 4],
            ['number' => '05', 'letter' => 'J', 'title_en' => 'Storage & Inland Transport', 'title_ar' => 'تخزين ونقل داخلي', 'description_en' => 'Arranging temporary storage and onward transport from the point of release to your warehouse anywhere in the Kingdom.', 'description_ar' => 'ترتيب التخزين المؤقت والنقل من نقطة التخليص إلى مستودعك في أي مكان من المملكة.', 'sort_order' => 5],
        ];
        foreach ($services as $service) {
            Service::create(array_merge($service, ['is_active' => true]));
        }

        // Process Steps
        ProcessStep::truncate();
        $steps = [
            ['step_number' => 1, 'title_en' => 'Document Intake', 'title_ar' => 'استلام المستندات', 'description_en' => 'Invoice, bill of lading & certificates of origin', 'description_ar' => 'الفاتورة وبوليصة الشحن وشهادات المنشأ', 'sort_order' => 1],
            ['step_number' => 2, 'title_en' => 'Customs Classification', 'title_ar' => 'التصنيف الجمركي', 'description_en' => 'Determining the tariff code and duties owed', 'description_ar' => 'تحديد الرمز الجمركي والرسوم المستحقة', 'sort_order' => 2],
            ['step_number' => 3, 'title_en' => 'Inspection', 'title_ar' => 'الفحص', 'description_en' => 'On-site follow-up during customs inspection', 'description_ar' => 'متابعة ميدانية خلال الفحص الجمركي', 'sort_order' => 3],
            ['step_number' => 4, 'title_en' => 'Duties & Clearance Stamp', 'title_ar' => 'الرسوم وختم التخليص', 'description_en' => 'Settling fees and securing the release', 'description_ar' => 'تسديد الرسوم والحصول على ختم الإفراج', 'sort_order' => 4],
            ['step_number' => 5, 'title_en' => 'Delivery', 'title_ar' => 'التسليم', 'description_en' => 'Handover, or onward transport arranged', 'description_ar' => 'التسليم أو ترتيب النقل إلى الوجهة', 'sort_order' => 5],
        ];
        foreach ($steps as $step) {
            ProcessStep::create($step);
        }

        // Trust Items
        TrustItem::truncate();
        $trustItems = [
            ['title_en' => 'Direct follow-up, no middlemen', 'title_ar' => 'متابعة مباشرة دون وسطاء', 'description_en' => 'The people who own your file follow it themselves from day one, with updates as they happen.', 'description_ar' => 'الأشخاص المسؤولون عن ملفك يتابعونه بأنفسهم منذ اليوم الأول مع تحديثات فورية.', 'sort_order' => 1],
            ['title_en' => 'Deep knowledge of every customs office', 'title_ar' => 'معرفة عميقة بكل دائرة جمركية', 'description_en' => 'Years of fieldwork at the same ports and crossings have earned us a working relationship built on trust.', 'description_ar' => 'سنوات من العمل الميداني في الموانئ والمعابر ذاتها أكسبتنا علاقة عمل قائمة على الثقة.', 'sort_order' => 2],
            ['title_en' => 'Full transparency on fees', 'title_ar' => 'شفافية كاملة في الرسوم', 'description_en' => 'You know the clearance cost before we start — no surprise line items at handover.', 'description_ar' => 'تعرف تكلفة التخليص قبل أن نبدأ — لا بنود مفاجئة عند التسليم.', 'sort_order' => 3],
        ];
        foreach ($trustItems as $item) {
            TrustItem::create(array_merge($item, ['is_active' => true]));
        }

        // Team Members
        TeamMember::truncate();
        $members = [
            ['name_en' => 'Murad Alzoubi', 'name_ar' => 'مراد الزعبي', 'role_en' => 'General Manager', 'role_ar' => 'المدير العام', 'description_en' => 'Oversees company strategy and relationships with major clients and customs authorities.', 'description_ar' => 'يشرف على استراتيجية الشركة وعلاقاتها مع كبار العملاء والجمارك.', 'phone' => '+962795171895', 'initials' => 'MA', 'sort_order' => 1, 'is_active' => true],
            ['name_en' => 'Aesar Alzoubi', 'name_ar' => 'عيسار الزعبي', 'role_en' => 'Operations Manager', 'role_ar' => 'مدير العمليات', 'description_en' => 'Follows clearance transactions day to day, and is the direct point of contact for active shipment files.', 'description_ar' => 'يتابع معاملات التخليص يوماً بيوم، وهو نقطة الاتصال المباشرة لملفات الشحن النشطة.', 'phone' => '+962788038016', 'initials' => 'AA', 'sort_order' => 2, 'is_active' => true],
        ];
        foreach ($members as $member) {
            TeamMember::create($member);
        }

        // Contact Phones
        ContactPhone::truncate();
        $phones = [
            ['label_en' => 'Office phone', 'label_ar' => 'هاتف المكتب', 'phone' => '0785171895', 'sort_order' => 1],
            ['label_en' => 'General Manager — Murad Alzoubi', 'label_ar' => 'المدير العام — مراد الزعبي', 'phone' => '0795171895', 'sort_order' => 2],
            ['label_en' => 'Operations Manager — Aesar Alzoubi', 'label_ar' => 'مدير العمليات — عيسار الزعبي', 'phone' => '0788038016', 'sort_order' => 3],
        ];
        foreach ($phones as $phone) {
            ContactPhone::create(array_merge($phone, ['is_active' => true]));
        }

        // Contact Location
        ContactLocation::updateOrCreate(['id' => 1], [
            'title_en'   => 'Al Bassem Complex — Gardens Street, Amman',
            'title_ar'   => 'مجمع الباسم — شارع الحدائق، عمّان',
            'address_en' => "Amman — Gardens Street, Al Bassem Complex 3\nFloor 2 — Office No. 211",
            'address_ar' => "عمّان — شارع الحدائق، مجمع الباسم 3\nالطابق الثاني — مكتب رقم 211",
            'maps_link'  => 'https://www.google.com/maps/search/?api=1&query=Gardens%20Street%20Al%20Bassem%20Complex%20Amman%20Jordan',
        ]);
    }
}
