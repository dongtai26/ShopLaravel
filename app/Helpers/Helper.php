<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Helper
{
    public static function menu($menus, $parent_id = 0, $char = '')
    {
        $html = '';
        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '
                <tr>
                    <td>' . $menu->id . '</td>
                    <td>' . $char . $menu->name . '</td>
                    <td>' . self::active($menu->active) . '</td>
                    <td>' . $menu->updated_at . '</td>
                    <td>
                    <a class ="btn btn-primary btn-sm" href="/admin/menus/edit/' .$menu->id. '">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="" class="btn btn-danger btn-sm"
                    onclick="removeRow('.$menu->id.', \'/admin/menus/destroy\')">
                        <i class="fas fa-trash"></i>
                    </a>
                    </td>
                </tr>
                ';

                unset($menus[$key]);

                $html .= self::menu($menus, $menu->id, $char . '|--');
            }
        }

        return $html;
    }

    public static function active($active = 0): string
    {
        return $active == 0 ? '<span class="btn btn-danger btn-xs">Inactive</span>' : '<span class="btn btn-success btn-xs">Active</span>';
    }

    public static function menus($menus, $parent_id = 0)
    {
        $html = '';
        foreach ($menus as $key => $menu) {
            if($menu->parent_id == $parent_id) {
                $html .= '
                <li>
                    <a href="/Menu/' .$menu->id. '-' . Str::slug($menu->name, '-') . '.html">
                        '.$menu->name.'
                    </a>';
                unset($menus[$key]);
                if (Self::isChild($menus, $menu->id)) {
                    $html .= '<ul class="sub-menu">';
                    $html .= Self::menus($menus, $menu->id);
                    $html .= '</ul>';
                }
                $html .= '</li>';
            }
        }

        return $html;
    }

    public static function isChild($menus, $id)
    {
        foreach($menus as $key => $menu) {
            if ($menu->parent_id == $id) {
                return true;
            }
        }
        return false;
    }

    public static function price($price = 0, $price_sale = 0)
    {
        if ($price_sale != 0) return number_format($price_sale);
        if ($price != 0) return number_format($price);
        return '<a href="/contact">Contact</a>';
    }
}
