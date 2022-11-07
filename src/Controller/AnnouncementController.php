<?php

namespace App\Controller;

use App\Model\AnnouncementManager;
use App\Model\RegionManager;

class AnnouncementController extends AbstractController
{
    public const EVENTS = [
        0 => 'tous',
        1 => 'evenements',
        2 => 'restaurations',
        3 => 'hebergements'
    ];

    private int $perPage = 3;

    /**
     * List announcements
     */
    public function index(): string
    {
        $announcementManager = new AnnouncementManager();
        $active = 'tous';
        $regionManager = new RegionManager();
        $where = [];
        $selected = '';
        $page = 1;
        $error = '';
        if (!(empty($_GET))) {
            $where = $_GET;
            if (isset($where['search'])) {
                $where['search'] = htmlentities($where['search']);
            } else {
                if (isset($where['page'])) {
                    unset($where['page']);
                }
                if (isset($where['region_id'])) {
                    if (is_int((int) $where['region_id'])) {
                        $selected = $where['region_id'];
                    } else {
                        $error .= 'Region n\'existe pas. ';//throw new \Exception('Region n\'existe pas');
                    }
                }
                if (isset($where['category'])) {
                    if (in_array($where['category'], self::EVENTS)) {
                        $active = $where['category'];
                    } else {
                        $error .= 'Categorie n\'existe pas'; //throw new \Exception('Categorie n\'existe pas');
                    }
                }
            }
        }
        $regions = $regionManager->select();
        if ($error) {
            $where = [];
        }
        $announcements = $announcementManager->select($where);

        $numrows = count($announcements);
        $numpages = ceil($numrows / $this->perPage);

        if ($numpages > 1) {
            $page = (!isset($_GET['page']) || $_GET['page'] == 0 || $_GET['page'] > $numpages) ? 1 : $_GET['page'];
            $begin = ($page - 1) * $this->perPage;
            $end = $this->perPage;
            $where['limitQuery'] = ' LIMIT ' . $begin . ',' . $end;
            //$where['pageURL'] = '&page=' . $where['page'];
            $announcements = $announcementManager->select($where);
            unset($where['limitQuery']);
        }
        return $this->twig->render('Announcement/index.html.twig', ['announcements' => $announcements,
        'events' => self::EVENTS, 'active' => $active, 'regions' => $regions, 'selected' => $selected,
        'numpages' => $numpages, 'where' => $where, 'page' => $page, 'error' => $error]);
    }
}
