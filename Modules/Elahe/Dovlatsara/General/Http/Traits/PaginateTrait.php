<?php

namespace Modules\General\Http\Traits;

trait PaginateTrait
{
    public function paginateObjects($page, $totalPage)
    {
        if ($totalPage>2) {
            $pagination = '<nav><ul class="pagination">';
            if ($page > 1)
                $z = $page - 1;
            else
                $z = $page;
            $pagination .= '<li class="page-item" aria-disabled="true" aria-label="« قبلی">';
            $pagination .= '<a class="page-link" style="cursor: pointer" onclick="changePage(' . $z . ')" rel="next" aria-label="« قبلی">‹</a></li>';

//            $pagination .= '<span class="page-link" style="cursor: pointer" aria-hidden="true">‹</span></li>';
            for ($i = 1; $i <= $totalPage; $i++) {
                if ($i == $page)
                    $pagination .= '<li class="page-item active"><a class="page-link" style="cursor: pointer" onclick="changePage(' . $i . ')">' . $i . '</a></li>';
                else
                    $pagination .= '<li class="page-item "><a class="page-link" style="cursor: pointer"  onclick="changePage(' . $i . ')">' . $i . '</a></li>';
            }
            if ($page == $totalPage)
                $y = $page;
            else
                $y = $page + 1;
            $pagination .= '<li class="page-item" aria-disabled="true">';
            $pagination .= '<a class="page-link" style="cursor: pointer" onclick="changePage(' . $y . ')" rel="next" aria-label="بعدی »">›</a>';
            $pagination .= '</li></ul></nav>';
        }else
            $pagination = '';
        return $pagination;
    }

}
