<?php
/**
 * Created by PhpStorm.
 * User: htmboy
 * Date: 20-8-19
 * Time: 下午7:59
 */

namespace App\Services;


use App\Models\Position;
use phpDocumentor\Reflection\Types\Integer;
use PhpParser\Node\Scalar\String_;

class PositionService
{
    /**
     *
     * @param $slug 地名拼音组合
     *
     * “地名-地名”的形式组合
     * 将组合进行拆解，并找到对于的id
     *
     * @return Integer
     */
    public function slugToId($slug)
    {
        list($city, $town) = explode('_', $slug);
        $town_positions = Position::where('slug', $town)->get();
        if($town_positions->count() == 1 )
        {
            return $town_positions->first()->id;
        }
        foreach ($town_positions as $town_position)
        {
            $city_position = Position::find($town_position->parent_id);
            if($city_position->slug == $city)
                return $town_position->id;
        }
        return null;
    }

    /**
     * @param Position $position position对象
     * @param bool $is_pinyin 是否以拼音字母的形式
     * @return String 返回的类型
     */
    public function positionToSlugs(Position $position, $is_pinyin = true) : String
    {
        return $this->toSlugs($position, $is_pinyin);
    }

    public function positionToProvinceSlugs(Position $position, $is_pinyin = true) : String
    {
        return $this->toSlugs($position, $is_pinyin, true);
    }

    public function idToSlugs($id, $is_pinyin = true) : String
    {
        $position = Position::find($id);
        return $this->toSlugs($position, $is_pinyin);
    }

    public function idToProvinceSlugs($id, $is_pinyin = true)
    {
        $position = Position::find($id);
        return $this->toSlugs($position, $is_pinyin, true);
    }

    private function toSlugs($position, $is_pinyin, $withProvince = false)
    {
        $parent = Position::find($position->parent_id);
        if ($withProvince && $position->level >= 3)
            $province = Position::find(explode('-', trim($position->path, '-'))[0]);
        if($is_pinyin)
        {
            return isset($province) ? $province->slug . '_' . $parent->slug . '_' . $position->slug : $parent->slug . '_' . $position->slug;

        }
        return isset($province) ? $province->place . '-' . $parent->place . '-' . $position->place : $parent->place . '-' . $position->place;
    }

    public function getProvinceMap()
    {
        return Position::where('parent_id', 0)->get()->keyBy('id')->map(function ($item){
            return $item->place;
        });
    }

    public function pathToPlace(Array $ids, $pinyin = true) : string
    {
        return implode('-', Position::whereIn('id', $ids)->orderBy('level')->get()->map(function ($item) use ($pinyin){
//            dd($item);
            return $pinyin ? $item->slug : $item->place;
        })->toArray());
    }

}