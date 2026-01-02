<?php

namespace App\Http\Controllers;

use App\Enums\ContactTypeEnum;
use App\Enums\DayEnum;
use App\Models\AfterSale;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Brochure;
use App\Models\Career;
use App\Models\Contact;
use App\Models\OperationalHour;
use App\Models\Outlet;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Promotion;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\View\View;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class HomeController extends Controller
{
    public function index(): View
    {
        if (request()->has('s')) {
            return $this->search();
        }

        $banners = Banner::query()
            ->select(['title', 'image'])
            ->orderByDesc('id')
            ->where('status', 1)
            ->get();

        $profile = Profile::query()
            ->select(['address', 'short_description', 'cover'])
            ->first();

        $services = Service::query()
            ->select(['title', 'icon', 'description'])
            ->orderBy('title')
            ->get();

        $blogs = Blog::query()
            ->select(['user_id', 'slug', 'title', 'image', 'content', 'created_at'])
            ->where('status', 1)
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        $products = Product::query()
            ->select(['slug', 'title', 'image'])
            ->where('status', 1)
            ->orderByDesc('id')
            ->limit(6)
            ->get();

        $brochures = Brochure::query()
            ->select(['title', 'url'])
            ->orderByDesc('id')
            ->where('status', 1)
            ->get();

        $testimonials = Testimonial::query()
            ->select(['name', 'profession', 'image', 'testimonial'])
            ->where('status', 1)
            ->get();

        $operationalHours = OperationalHour::query()
            ->select(['day_from', 'day_to', 'open_time', 'close_time'])
            ->orderByRaw("CASE
            WHEN day_from = '" . DayEnum::Monday->value . "' THEN 1
            WHEN day_from = '" . DayEnum::Tuesday->value . "' THEN 2
            WHEN day_from = '" . DayEnum::Wednesday->value . "' THEN 3
            WHEN day_from = '" . DayEnum::Thursday->value . "' THEN 4
            WHEN day_from = '" . DayEnum::Friday->value . "' THEN 5
            WHEN day_from = '" . DayEnum::Saturday->value . "' THEN 6
            WHEN day_from = '" . DayEnum::Sunday->value . "' THEN 7
            END")
            ->get();

        $phoneFaxs = Contact::query()
            ->where(function ($query) {
                $query->where('type', ContactTypeEnum::PHONE->value)
                    ->orWhere('type', ContactTypeEnum::FAX->value);
            })
            ->whereNot('type', ContactTypeEnum::EMAIL->value)
            ->orderByDesc('type')
            ->get();

        $socMeds = Contact::query()
            ->whereNot('type', ContactTypeEnum::PHONE->value)
            ->whereNot('type', ContactTypeEnum::FAX->value)
            ->whereNot('type', ContactTypeEnum::EMAIL->value)
            ->orderBy('type')
            ->get();

        $emails = Contact::query()
            ->where('type', ContactTypeEnum::EMAIL->value)
            ->orderBy('contact')
            ->get();

        return view(
            'pages.home',
            compact(
                'banners',
                'profile',
                'services',
                'blogs',
                'products',
                'brochures',
                'testimonials',
                'operationalHours',
                'phoneFaxs',
                'socMeds',
                'emails'
            )
        );
    }

    public function search(): View
    {
        $search = request()->s;

        $products = Product::query()
            ->select(['slug', 'title', 'image'])
            ->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('content', 'LIKE', '%' . $search . '%');
            })
            ->where('status', 1)
            ->orderByDesc('id')
            ->get();

        $afterSales = AfterSale::query()
            ->select(['slug', 'title', 'image', 'created_at'])
            ->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('content', 'LIKE', '%' . $search . '%');
            })
            ->where('status', 1)
            ->orderByDesc('id')
            ->get();

        $blogs = Blog::query()
            ->select(['slug', 'title', 'image', 'created_at'])
            ->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('content', 'LIKE', '%' . $search . '%');
            })
            ->where('status', 1)
            ->orderByDesc('id')
            ->get();

        $promotions = Promotion::query()
            ->select(['slug', 'title', 'image', 'created_at'])
            ->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('content', 'LIKE', '%' . $search . '%');
            })
            ->where('status', 1)
            ->orderByDesc('id')
            ->get();

        $outlets = Outlet::query()
            ->with(['outletHasOperationalHours', 'outletHasServices'])
            ->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('address', 'LIKE', '%' . $search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $search . '%')
                    ->orWhere('fax', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('name')
            ->get();

        $careers = Career::query()
            ->with(['careerPlacements', 'careerPlacements.city'])
            ->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%')
                    ->orWhere('requirement', 'LIKE', '%' . $search . '%');
            })
            ->where('status', 1)
            ->orderByDesc('registration_from')
            ->get();

        $profile = Profile::query()
            ->select(['address', 'short_description', 'cover'])
            ->first();

        $brochures = Brochure::query()
            ->select(['title', 'url'])
            ->orderByDesc('id')
            ->where('status', 1)
            ->get();

        $operationalHours = OperationalHour::query()
            ->select(['day_from', 'day_to', 'open_time', 'close_time'])
            ->orderByRaw("CASE
            WHEN day_from = '" . DayEnum::Monday->value . "' THEN 1
            WHEN day_from = '" . DayEnum::Tuesday->value . "' THEN 2
            WHEN day_from = '" . DayEnum::Wednesday->value . "' THEN 3
            WHEN day_from = '" . DayEnum::Thursday->value . "' THEN 4
            WHEN day_from = '" . DayEnum::Friday->value . "' THEN 5
            WHEN day_from = '" . DayEnum::Saturday->value . "' THEN 6
            WHEN day_from = '" . DayEnum::Sunday->value . "' THEN 7
            END")
            ->get();

        $phoneFaxs = Contact::query()
            ->where(function ($query) {
                $query->where('type', ContactTypeEnum::PHONE->value)
                    ->orWhere('type', ContactTypeEnum::FAX->value);
            })
            ->whereNot('type', ContactTypeEnum::EMAIL->value)
            ->orderByDesc('type')
            ->get();

        $socMeds = Contact::query()
            ->whereNot('type', ContactTypeEnum::PHONE->value)
            ->whereNot('type', ContactTypeEnum::FAX->value)
            ->whereNot('type', ContactTypeEnum::EMAIL->value)
            ->orderBy('type')
            ->get();

        $emails = Contact::query()
            ->where('type', ContactTypeEnum::EMAIL->value)
            ->orderBy('contact')
            ->get();

        return view('pages.search', compact(
            'search',
            'products',
            'afterSales',
            'blogs',
            'promotions',
            'outlets',
            'careers',
            'profile',
            'brochures',
            'operationalHours',
            'phoneFaxs',
            'socMeds',
            'emails'
        ));
    }

    public function sitemap(): void
    {
        $sitemap = Sitemap::create();
        $sitemap->add(Url::create('/'));
        $sitemap->add(Url::create('/profile'));
        $sitemap->add(Url::create('/blogs'));
        Blog::where('status', 1)->get()->each(function ($blog) use ($sitemap) {
            $sitemap->add(
                Url::create("/blogs/{$blog->slug}")
                    ->setLastModificationDate($blog->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8)
            );
        });
        $sitemap->add(Url::create('/after-sales'));
        AfterSale::where('status', 1)->get()->each(function ($afterSale) use ($sitemap) {
            $sitemap->add(
                Url::create("/after-sales/{$afterSale->slug}")
                    ->setLastModificationDate($afterSale->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8)
            );
        });
        $sitemap->add(Url::create('/promotions'));
        Promotion::where('status', 1)->get()->each(function ($promotion) use ($sitemap) {
            $sitemap->add(
                Url::create("/promotions/{$promotion->slug}")
                    ->setLastModificationDate($promotion->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8)
            );
        });
        $sitemap->add(Url::create('/products'));
        Product::where('status', 1)->get()->each(function ($product) use ($sitemap) {
            $sitemap->add(
                Url::create("/products/{$product->slug}")
                    ->setLastModificationDate($product->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8)
            );
        });
        $sitemap->add(Url::create('/outlets'));
        $sitemap->add(Url::create('/careers'));
        Career::where('status', 1)->get()->each(function ($career) use ($sitemap) {
            $sitemap->add(
                Url::create("/careers/{$career->slug}")
                    ->setLastModificationDate($career->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8)
            );
        });
        $sitemap->writeToFile(public_path('/sitemap/armadamobil/sitemap.xml'));
        $sitemap->writeToFile(public_path('/sitemap/armadamobilisuzu/sitemap.xml'));
    }
}
