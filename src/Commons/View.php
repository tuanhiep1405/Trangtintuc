<?php

namespace Assignment\Php2News\Commons;

class View extends Controller
{

    // Hàm e404: Hiển thị trang 404 (lỗi không tìm thấy trang)
    public function e404()
    {
        return $this->renderViewAdmin('pages.e404');
    }
    
}
