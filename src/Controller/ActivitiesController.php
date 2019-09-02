<?php

namespace App\Controller;

use App\Entity\Activity;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ActivitiesController
 * @package App\Controller
 */
class ActivitiesController extends FOSRestController
{
    /**
     * @Route("/activities/{limit}/{offset}/{priceOrder}", name="activities", defaults={"limit": 20, "offset": 0, "priceOrder": "ASC"})
     */
    public function index(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Activity::class);

        return $this->json([
            'activities' => $repository->getActivities($request->attributes->get('limit'), $request->attributes->get('offset'), $request->attributes->get('priceOrder'))
        ]);
    }

    /**
     * @Route("activities/popular/{value}/{limit}/{offset}/{priceOrder}", name="popular_activities", defaults={"limit": 20, "offset": 0, "priceOrder": "ASC"})
     */
    public function popular(Request $request, $value)
    {
        if (empty($value) || !in_array($value, [0, 1])) {
            return $this->json([
                'error' => 'Excepted 0 or 1',
            ], 400);
        }

        $repository = $this->getDoctrine()->getRepository(Activity::class);

        return $this->json([
            'activities' => $repository->getPopularActivities($value, $request->attributes->get('limit'), $request->attributes->get('offset'), $request->attributes->get('priceOrder'))
        ]);
    }

    /**
     * @Route("activities/category/{value}/{limit}/{offset}/{priceOrder}", name="category_activities", defaults={"limit": 20, "offset": 0, "priceOrder": "ASC"})
     */
    public function category(Request $request, $value)
    {
        $repository = $this->getDoctrine()->getRepository(Activity::class);

        return $this->json([
            'activities' => $repository->getByCategory($value, $request->attributes->get('limit'), $request->attributes->get('offset'), $request->attributes->get('priceOrder'))
        ]);
    }

    /**
     * @Route("activities/maxprice/{value}/{limit}/{offset}/{priceOrder}", name="maxprice_activities", defaults={"limit": 20, "offset": 0, "priceOrder": "ASC"})
     */
    public function maxprice(Request $request, $value)
    {
        if (empty($value) || !is_numeric($value)) {
            return $this->json([
                'error' => 'Set valid value',
            ], 400);
        }

        $repository = $this->getDoctrine()->getRepository(Activity::class);

        return $this->json([
            'activities' => $repository->getByMaxPrice($value, $request->attributes->get('limit'), $request->attributes->get('offset'), $request->attributes->get('priceOrder'))
        ]);
    }
}
