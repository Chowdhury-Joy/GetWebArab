<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->posts() as $post) {
            BlogPost::firstOrCreate(['slug' => $post['slug']], $post);
        }
    }

    protected function posts(): array
    {
        return [
            [
                'title' => 'How Much Should a Business Website Really Cost in the UAE in 2026?',
                'slug' => 'how-much-should-a-website-cost-in-uae',
                'excerpt' => 'A breakdown of what UAE local businesses actually pay for websites in 2026 — agency quotes, freelancer rates, and what a fair, fixed-price setup should include.',
                'meta_title' => 'Website Cost in the UAE 2026: What Local Businesses Should Expect to Pay',
                'meta_description' => 'A clear breakdown of website pricing in the UAE for 2026 — agency quotes, freelancer rates, hidden fees, and what a fair fixed-price package should include.',
                'status' => 'published',
                'published_at' => now()->subDays(28),
                'content' => <<<'HTML'
<p>If you've asked three different web agencies in Dubai or Abu Dhabi for a quote, you've probably gotten three wildly different numbers — anywhere from 1,500 AED to 25,000 AED for what sounds like the same website. That gap isn't random. It usually comes down to what's actually included, and what gets added as a "surprise" invoice three months in.</p>

<h2>What UAE businesses typically pay in 2026</h2>
<p>Based on current market rates across the UAE, here's roughly where the money goes:</p>
<ul>
<li><strong>Freelancers:</strong> 800–3,000 AED for a basic template site. Fast and cheap, but support usually disappears after handover, and updates cost extra every time.</li>
<li><strong>Traditional agencies:</strong> 5,000–25,000+ AED upfront, often with a 12-month contract. You get a custom design, but rarely a guarantee that it actually brings in customers.</li>
<li><strong>DIY builders (Wix, Squarespace):</strong> 100–300 AED/month in platform fees, plus your own time. Fine for a hobby site, risky for a business that depends on local search traffic.</li>
</ul>

<h2>The real cost isn't just the build — it's what happens after</h2>
<p>A website is not a one-time purchase like a laptop. It needs hosting, security patches, backups, and small content edits on an ongoing basis. Most quotes only cover the initial build, so ask directly: <em>"What happens after launch if something breaks, or I need to update a phone number?"</em> If the answer involves a new invoice every time, factor that into your real annual cost.</p>

<h2>What a fair package should include</h2>
<p>For a UAE local business — a clinic, salon, restaurant, trading company, or service provider — a fair setup should cover:</p>
<ul>
<li>A mobile-first, bilingual (English/Arabic) site built to convert visitors into calls or bookings</li>
<li>Hosting, SSL, and daily backups included, not billed separately</li>
<li>A fixed monthly care fee instead of a 12-month lock-in contract</li>
<li>Clear ownership: your domain, your code, your ad accounts — always in your name</li>
</ul>

<h2>Our approach</h2>
<p>At Get Web Arab, we charge a fixed 800 AED setup fee and a flat monthly care fee — no hidden invoices, no 12-month contracts. You can see the exact AED price before you commit using our <a href="/#offer-stack">pricing calculator</a>.</p>
HTML,
            ],
            [
                'title' => "Local SEO for UAE Businesses: The Complete Beginner's Guide",
                'slug' => 'local-seo-guide-uae-businesses',
                'excerpt' => 'How UAE local businesses can rank higher on Google Maps and local search results — Google Business Profile, reviews, and the on-page basics that actually move the needle.',
                'meta_title' => 'Local SEO Guide for UAE Businesses: Rank Higher on Google Maps',
                'meta_description' => "A beginner-friendly guide to local SEO for UAE businesses — Google Business Profile setup, reviews, citations, and on-page basics that actually improve rankings.",
                'status' => 'published',
                'published_at' => now()->subDays(21),
                'content' => <<<'HTML'
<p>When someone in Dubai searches "plumber near me" or "best salon in Al Ain," Google doesn't show every business in the UAE — it shows the handful it thinks are most relevant and trustworthy for that searcher's location. Local SEO is the practice of convincing Google that your business belongs in that shortlist. It's not magic, and it's not overnight, but the basics are learnable.</p>

<h2>1. Claim and complete your Google Business Profile</h2>
<p>This is the single highest-impact thing a local business can do. Go to Google Business Profile, claim your listing, and fill in <strong>every</strong> field: category, hours, phone number, service area, and photos. An incomplete profile is one of the most common reasons a legitimate local business gets outranked by a competitor with a fuller listing.</p>

<h2>2. Keep your name, address, and phone number identical everywhere</h2>
<p>Google cross-checks your business details across the web — your website, your Google listing, directories like Yellow Pages UAE, social profiles. If your phone number is written differently in two places, it quietly erodes trust signals. Pick one exact format and use it everywhere.</p>

<h2>3. Get reviews — and reply to them</h2>
<p>Review count and recency are ranking factors, not just trust signals for customers. Ask satisfied customers directly for a Google review right after a good experience (a simple WhatsApp message with your review link works well). Reply to every review, good or bad — it shows Google (and future customers) that the business is active and accountable.</p>

<h2>4. Make sure your website actually says where you operate</h2>
<p>A surprising number of local business websites never mention their city or service area in plain text. If you serve Dubai, Sharjah, and Abu Dhabi, say so clearly on your homepage and service pages — not just in an image or a map embed, which Google can't read.</p>

<h2>5. Speed and mobile experience matter more locally, not less</h2>
<p>Most local searches happen on a phone, often while someone is standing outside deciding whether to walk in. A slow-loading site loses that customer before they even see what you offer.</p>

<h2>Local SEO is a monthly habit, not a one-time project</h2>
<p>The businesses that win local search aren't the ones who did a big SEO push once — they're the ones steadily collecting reviews, keeping listings accurate, and publishing the occasional useful content month after month. That's exactly what our <a href="/#pillars">ongoing SEO service</a> is built to do, without you having to think about it.</p>
HTML,
            ],
            [
                'title' => 'Google Ads vs. Meta Ads for UAE Local Businesses: Which Should You Choose?',
                'slug' => 'google-ads-vs-meta-ads-uae',
                'excerpt' => 'Google Ads and Meta Ads solve different problems for UAE local businesses. Here is how to decide which one deserves your first ad dirham.',
                'meta_title' => 'Google Ads vs Meta Ads for UAE Local Businesses (2026 Guide)',
                'meta_description' => 'Not sure whether to spend your ad budget on Google or Meta? Here is a practical comparison for UAE local businesses deciding where to start.',
                'status' => 'published',
                'published_at' => now()->subDays(14),
                'content' => <<<'HTML'
<p>Every UAE business owner eventually gets asked the same question by a marketing person: "Google or Meta?" The honest answer is that they solve different problems — and picking the wrong one first is a common way to waste an ad budget.</p>

<h2>Google Ads: capturing demand that already exists</h2>
<p>Google Ads shows up when someone actively searches for what you sell — "emergency AC repair Dubai," "corporate gift suppliers UAE." This is <strong>demand capture</strong>: the customer already has the need, and you're making sure you're the answer they find first.</p>
<p>Google Ads tends to work best for:</p>
<ul>
<li>Services people search for urgently (repairs, medical, legal, logistics)</li>
<li>High-intent purchases where people compare options before buying</li>
<li>Businesses with a clear service area they can target by location</li>
</ul>

<h2>Meta Ads (Facebook &amp; Instagram): creating demand that didn't exist yet</h2>
<p>Meta Ads work differently — you're not waiting for a search, you're interrupting someone's scroll with something visually interesting enough to stop for. This is <strong>demand generation</strong>, and it depends heavily on strong photos or video, not just good copy.</p>
<p>Meta tends to work best for:</p>
<ul>
<li>Visual products and services (restaurants, salons, retail, home décor)</li>
<li>Building brand awareness in a specific neighborhood or community</li>
<li>Offers, promotions, and limited-time deals that reward impulse action</li>
</ul>

<h2>So which one first?</h2>
<p>If people actively search for what you do, start with Google Ads — you're capturing customers who are ready to act right now, which usually means a faster, more measurable return. If your business is more visual and discovery-driven (a new café, a boutique, an aesthetic clinic), Meta Ads often produces better early results because it can introduce you to people who didn't know they wanted you yet.</p>
<p>Most established local businesses eventually run both — Google to catch active searchers, Meta to stay visible to past visitors and expand reach. The mistake is running both badly with a tiny, split budget instead of doing one well first.</p>

<h2>A note on managing your own ad spend</h2>
<p>Whichever platform you choose, insist on transparency: your ad budget should be billed directly to your own card, not marked up or routed through an agency's account. That way you always see exactly what was spent and what it returned. That's exactly how we run <a href="/#offer-stack">Ads as a service</a> at Get Web Arab — we manage the campaigns, your budget stays yours.</p>
HTML,
            ],
            [
                'title' => 'Why Your Website Needs Ongoing Care (Not Just a One-Time Build)',
                'slug' => 'why-your-website-needs-ongoing-care',
                'excerpt' => "A website is not a 'build it once and forget it' asset. Here is what actually breaks over time, and why ongoing care prevents it from costing you customers.",
                'meta_title' => 'Why Websites Need Ongoing Care, Not Just a One-Time Build',
                'meta_description' => 'Websites decay without maintenance — broken plugins, expired security certificates, outdated content. Here is what ongoing website care actually prevents.',
                'status' => 'published',
                'published_at' => now()->subDays(7),
                'content' => <<<'HTML'
<p>A common assumption among first-time business owners is that a website is a one-time expense — you pay to build it, it goes live, and it just works forever, like a signboard outside your shop. In reality, a website behaves more like a car than a signboard: it needs regular attention, or small issues quietly turn into big ones.</p>

<h2>What actually breaks without maintenance</h2>
<ul>
<li><strong>Security certificates expire.</strong> An expired SSL certificate shows visitors a scary "Not Secure" warning before they even see your homepage — most people leave immediately.</li>
<li><strong>Software gets outdated.</strong> Websites built on platforms like WordPress rely on plugins and themes that need regular updates. Skip enough updates and you become an easy target for hackers, or the site simply stops working after a routine host upgrade.</li>
<li><strong>Content goes stale.</strong> Old promotions, outdated prices, a phone number that changed two years ago — every stale detail chips away at trust the moment a customer notices it.</li>
<li><strong>Hosting and backups get forgotten.</strong> Without automated backups, a single server failure or hacking attempt can wipe out a website with no way to recover it.</li>
</ul>

<h2>The hidden cost of "set and forget"</h2>
<p>The real cost of skipping maintenance isn't usually a dramatic crash — it's a slow leak. A site that loads a little slower every month, ranks a little lower, and quietly converts fewer visitors into customers. Most owners don't notice until a competitor's newer, faster site starts consistently outranking theirs.</p>

<h2>What proper website care should include</h2>
<ul>
<li>Uptime monitoring, so you know immediately if the site goes down</li>
<li>Daily backups, so a worst-case scenario is a quick restore, not a rebuild</li>
<li>Security patches applied on a schedule, not "whenever someone remembers"</li>
<li>Small content edits — a new price, a new team member, a holiday notice — without needing a developer each time</li>
</ul>

<h2>Our approach</h2>
<p>This is exactly why we don't sell websites as a one-time build. Every site we launch includes <a href="/#offer-stack">24/7 Care &amp; Hosting</a> as standard — security, backups, uptime, and small edits — for one fixed monthly fee, so the site that took months to build doesn't quietly decay a year later.</p>
HTML,
            ],
            [
                'title' => 'Email Marketing for Local Businesses: Turning One-Time Customers Into Repeat Buyers',
                'slug' => 'email-marketing-for-local-businesses',
                'excerpt' => 'Winning a customer once is the easy part. Here is how simple, consistent email marketing keeps UAE local businesses top of mind for the next purchase.',
                'meta_title' => 'Email Marketing for Local Businesses: Keep Customers Coming Back',
                'meta_description' => 'A practical look at how UAE local businesses use email marketing to bring past customers back, without needing a big marketing team.',
                'status' => 'published',
                'published_at' => now()->subDays(3),
                'content' => <<<'HTML'
<p>Most local businesses spend almost all of their marketing effort chasing new customers — ads, SEO, referrals — and almost none staying in touch with people who already bought from them once. That's a missed opportunity, because a past customer is far cheaper to bring back than a stranger is to convince for the first time.</p>

<h2>Why email still works in 2026</h2>
<p>Unlike social media, where an algorithm decides who sees your post, an email goes directly into someone's inbox. It's one of the few marketing channels a small business fully owns — no platform can suddenly change the rules and cut your reach in half overnight.</p>

<h2>What to actually send</h2>
<p>You don't need a large list or a complicated strategy to get started. A simple, consistent rhythm beats an occasional big campaign:</p>
<ul>
<li><strong>A welcome message</strong> right after someone's first purchase or booking, thanking them and setting expectations for what's next.</li>
<li><strong>A monthly update</strong> — a new service, a seasonal offer, a helpful tip related to what you sell. Useful, not just promotional.</li>
<li><strong>A "we miss you" nudge</strong> for customers who haven't come back in a while, often with a small, time-limited incentive.</li>
<li><strong>Review requests</strong> timed right after a good experience, which also feeds directly into your local SEO efforts.</li>
</ul>

<h2>The mistake most businesses make</h2>
<p>The most common failure isn't bad email copy — it's inconsistency. A business sends one email, sees modest results, and gives up. Email marketing compounds: the value comes from customers seeing your name reliably every month, not from one perfect campaign.</p>

<h2>Keep it simple and automated</h2>
<p>The businesses that stick with it are the ones who set it up once and let it run — a welcome sequence, a monthly send, and a win-back nudge, all automated so it happens whether or not you remembered this week. That's exactly what our <a href="/#pillars">Email</a> service handles: set up and sent on your behalf every month, so past customers keep hearing from you without it becoming another task on your plate.</p>
HTML,
            ],
            [
                'title' => '5 Signs Your UAE Business Website Is Losing You Customers',
                'slug' => 'signs-your-website-is-losing-customers',
                'excerpt' => "A website that looks fine to you might be quietly costing you leads. Here are five warning signs worth checking today.",
                'meta_title' => '5 Signs Your Business Website Is Losing You Customers',
                'meta_description' => 'Five common warning signs that a UAE business website is quietly losing customers — and what to do about each one.',
                'status' => 'published',
                'published_at' => now()->subDay(),
                'content' => <<<'HTML'
<p>Most business owners only think about their website when something obviously breaks. But a website can look perfectly fine on the surface while quietly turning away customers every single day. Here are five signs worth checking right now.</p>

<h2>1. It takes more than 3 seconds to load on a phone</h2>
<p>Most local searches happen on mobile, often on the go. Studies consistently show that a large share of visitors abandon a site that takes longer than three seconds to load. If your homepage feels sluggish on your own phone, it's costing you visitors before they even see what you offer.</p>

<h2>2. There's no clear way to contact you within one scroll</h2>
<p>If a visitor has to hunt for your phone number, WhatsApp link, or booking button, most of them simply won't bother. Your primary call-to-action should be visible immediately, and repeated as the visitor scrolls down the page.</p>

<h2>3. It hasn't been updated in over a year</h2>
<p>An outdated promotion, an old team photo, a service you no longer offer — these details signal to visitors (and to Google) that the business may not be very active. Regular small updates are a quiet but real trust signal.</p>

<h2>4. It doesn't look right on a phone</h2>
<p>Text that's too small, buttons that are hard to tap, images that overflow the screen — a site that wasn't properly built mobile-first will frustrate the majority of your visitors, since most of them are on a phone, not a desktop.</p>

<h2>5. You genuinely don't know how many leads it generates</h2>
<p>If you can't answer "how many inquiries did the website generate last month," you're flying blind. A website should be a measurable source of business, not a digital business card you hope is working.</p>

<h2>What to do about it</h2>
<p>Most of these issues aren't expensive to fix individually — but they add up, and they're easy to miss when you're busy running the business day to day. This is exactly the gap our <a href="/#offer-stack">Website Setup &amp; Care</a> package is built to close: a fast, mobile-first site that's actively maintained, not just launched once and left alone.</p>
HTML,
            ],
        ];
    }
}
