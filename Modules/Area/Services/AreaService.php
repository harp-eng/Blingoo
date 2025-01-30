<?php

namespace Modules\Area\Services;

use Modules\Area\Models\Area;
use Modules\Area\Models\AreaPolygon;
use Modules\Area\Models\AreaPostcode;
use Modules\Area\Models\AreaAvailability;

class AreaService
{
    /**
     * Store a new Area with related data.
     *
     * @param array $data
     * @return Area
     */
    public function storeArea(array $data): Area
    {
        // Create the Area
        $area = Area::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'area_type' => $data['area_type'],
            'vendor_id' => $data['vendor_id'],
            'status' => $data['status'],
            'created_by' => auth()->id(),
        ]);

        // Handle related data
        $this->handlePolygons($area, $data['polygons'] ?? []);
        $this->handlePostcodes($area, $data['postcodes'] ?? []);
        $this->handleAvailability($area, $data['availability'] ?? []);

        return $area;
    }

    /**
     * Update an existing Area with related data.
     *
     * @param Area $area
     * @param array $data
     * @return Area
     */
    public function updateArea($id, array $data): Area
    {
        $area = Area::findOrFail($id);

        // Update the Area
        $area->update([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'area_type' => $data['area_type'],
            'vendor_id' => $data['vendor_id'],
            'status' => $data['status'],
            'updated_by' => auth()->id(),
        ]);

        // Handle related data
        $this->handlePolygons($area, $data['polygons'] ?? []);
        $this->handlePostcodes($area, $data['postcodes'] ?? []);
        $this->handleAvailability($area, $data['availability'] ?? []);

        return $area;
    }

    /**
     * Handle Area Polygons.
     *
     * @param Area $area
     * @param array $polygons
     * @return void
     */
    protected function handlePolygons(Area $area, array $polygons): void
    {
        // Remove existing polygons
        $area->polygons()->delete();

        foreach ($polygons as $polygon) {
            AreaPolygon::create([
                'area_id' => $area->id,
                'coordinates' => $polygon['coordinates'],
                'sequence' => $polygon['sequence'] ?? null,
            ]);
        }
    }

    /**
     * Handle Area Postcodes.
     *
     * @param Area $area
     * @param array $postcodes
     * @return void
     */
    protected function handlePostcodes(Area $area, array $postcodes): void
    {
        // Remove existing postcodes
        $area->postcodes()->delete();

        foreach ($postcodes as $postcode) {
            AreaPostcode::create([
                'area_id' => $area->id,
                'postcode' => $postcode,
            ]);
        }
    }

    /**
     * Handle Area Availability.
     *
     * @param Area $area
     * @param array $availability
     * @return void
     */
    protected function handleAvailability(Area $area, array $availability): void
    {
        // Remove existing availability
        $area->availability()->delete();

        foreach ($availability as $availabilityItem) {
            AreaAvailability::create([
                'area_id' => $area->id,
                'day' => $availabilityItem['day'],
                'available' => $availabilityItem['available'],
            ]);
        }
    }
}
