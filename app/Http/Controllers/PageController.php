<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageAddRequest;
use App\Http\Requests\PageEditRequest;
use App\Support\Pages;
use App\Models\Page;
use App\Support\SectionTrait;

class PageController extends Controller
{
    use SectionTrait;

    private const SECTION_NAME = 'Page';

    private const HAS_IMAGE = true;
    private const IMAGE_FIELD_NAME = 'images';

    public static $indexFields;

    /**
     * Загрузка языковых значений/локализация
     */
    public static function boot(): void
    {
        self::$indexFields = [
            'alias' => __('admin.section_fields.alias'),
            'name' => __('admin.section_fields.name')
        ];
    }

    /**
     * Показ выбранной страницы в публичной части
     * @param $alias - псевдоним страницы /page/$alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($alias)
    {
        $alias = strip_tags($alias);

        $res = Page::where('alias', $alias)->firstOrFail();
        $page = Pages::toArray($res);

        return view('default.page', [
            'menu' => Pages::menu(),
            'page' => current($page)
        ]);
    }

    /**
     * Создание страницы
     * @param PageAddRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(PageAddRequest $request)
    {
        return $this->createElement($request);
    }

    /**
     * Изменение страницы
     * @param PageEditRequest $request
     * @param                 $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PageEditRequest $request, $id)
    {
        return $this->updateElement($request, $id);
    }

    /**
     * Получение записи по id из БД
     * @param int $id
     * @return mixed
     */
    private function getElement(int $id)
    {
        return Page::find($id);
    }
}
