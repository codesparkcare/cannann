<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Sitemap Controller
 * Generates a dynamic XML sitemap for Google Search Console
 * URL: https://hotelcanaann.com/sitemap.xml
 */
class Sitemap extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Room_model');
        $this->load->model('Blog_model');
    }

    public function index() {
        $base_url = 'https://hotelcanaann.com/';

        // Static pages with priority and change frequency
        $static_pages = [
            [
                'loc'        => $base_url,
                'changefreq' => 'daily',
                'priority'   => '1.0',
                'lastmod'    => date('Y-m-d'),
            ],
            [
                'loc'        => $base_url . 'about',
                'changefreq' => 'monthly',
                'priority'   => '0.8',
                'lastmod'    => date('Y-m-d'),
            ],
            [
                'loc'        => $base_url . 'rooms',
                'changefreq' => 'weekly',
                'priority'   => '0.9',
                'lastmod'    => date('Y-m-d'),
            ],
            [
                'loc'        => $base_url . 'restaurant',
                'changefreq' => 'weekly',
                'priority'   => '0.8',
                'lastmod'    => date('Y-m-d'),
            ],
            [
                'loc'        => $base_url . 'facilities',
                'changefreq' => 'monthly',
                'priority'   => '0.7',
                'lastmod'    => date('Y-m-d'),
            ],
            [
                'loc'        => $base_url . 'gallery',
                'changefreq' => 'weekly',
                'priority'   => '0.7',
                'lastmod'    => date('Y-m-d'),
            ],
            [
                'loc'        => $base_url . 'blogs',
                'changefreq' => 'weekly',
                'priority'   => '0.8',
                'lastmod'    => date('Y-m-d'),
            ],
            [
                'loc'        => $base_url . 'contact',
                'changefreq' => 'monthly',
                'priority'   => '0.6',
                'lastmod'    => date('Y-m-d'),
            ],
            [
                'loc'        => $base_url . 'internship',
                'changefreq' => 'monthly',
                'priority'   => '0.7',
                'lastmod'    => date('Y-m-d'),
            ],
        ];

        // Dynamic room pages
        $room_pages = [];
        $rooms = $this->Room_model->get_all_rooms();
        foreach ($rooms as $room) {
            if (!empty($room['slug'])) {
                $lastmod = !empty($room['updated_at']) ? date('Y-m-d', strtotime($room['updated_at'])) : date('Y-m-d');
                $room_pages[] = [
                    'loc'        => $base_url . 'room/' . $room['slug'],
                    'changefreq' => 'weekly',
                    'priority'   => '0.8',
                    'lastmod'    => $lastmod,
                ];
            }
        }

        // Dynamic blog pages
        $blog_pages = [];
        $blogs = $this->Blog_model->get_published_blogs();
        foreach ($blogs as $blog) {
            if (!empty($blog['slug'])) {
                $lastmod = !empty($blog['updated_at']) ? date('Y-m-d', strtotime($blog['updated_at'])) : date('Y-m-d');
                $blog_pages[] = [
                    'loc'        => $base_url . 'blog/' . $blog['slug'],
                    'changefreq' => 'monthly',
                    'priority'   => '0.6',
                    'lastmod'    => $lastmod,
                ];
            }
        }

        // Merge all URLs
        $all_urls = array_merge($static_pages, $room_pages, $blog_pages);

        // Output XML
        $this->output
            ->set_content_type('application/xml; charset=utf-8')
            ->set_output($this->_build_xml($all_urls));
    }

    /**
     * Build the XML sitemap string
     */
    private function _build_xml($urls) {
        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
        $xml .= '        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"' . "\n";
        $xml .= '        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9' . "\n";
        $xml .= '        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";

        foreach ($urls as $url) {
            $xml .= "\t<url>\n";
            $xml .= "\t\t<loc>" . htmlspecialchars($url['loc'], ENT_XML1) . "</loc>\n";
            $xml .= "\t\t<lastmod>" . $url['lastmod'] . "</lastmod>\n";
            $xml .= "\t\t<changefreq>" . $url['changefreq'] . "</changefreq>\n";
            $xml .= "\t\t<priority>" . $url['priority'] . "</priority>\n";
            $xml .= "\t</url>\n";
        }

        $xml .= '</urlset>';
        return $xml;
    }
}
