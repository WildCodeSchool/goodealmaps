<?php

namespace App\Controller;

use App\Model\AnnouncementManager;
use App\Model\RegionManager;

class AnnouncementController extends AbstractController
{
    private array $events = [
        0 => 'tous',
        1 => 'evenements',
        2 => 'restaurations',
        3 => 'hebergements'
    ];

    private int $perPage = 9;

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
        if (!(empty($_GET))) {
            $where = $_GET;
            if (isset($where['page'])) {
                unset($where['page']);
            }
            if (isset($where['region_id'])) {
                $selected = $where['region_id'];
            }
            if (isset($where['category'])) {
                $active = $where['category'];
            }
            if (isset($where['id'])) {
                unset($where['id']);
            }
        }
        $regions = $regionManager->select();
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
        'events' => $this->events, 'active' => $active, 'regions' => $regions, 'selected' => $selected,
        'numpages' => $numpages, 'where' => $where, 'page' => $page]);
    }

    /**
     * List announcements
     */
    public function selectCard(int $id): string
    {
        $announcementManager = new AnnouncementManager();
        $announcement = $announcementManager->selectById($id);
        $announcement['ref'] = $_SERVER['HTTP_REFERER'];
        return $this->twig->render('Announcement/card.html.twig', ['announcement' => $announcement]);
    }

    /**
     * Delete announcement with given id
     */
    public function delete(int $id): void
    {
        $announcementManager = new AnnouncementManager();
        $announcementManager->deleteById($id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

}
