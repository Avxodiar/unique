<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamAddRequest;
use App\Http\Requests\TeamEditRequest;
use App\Models\People;
use App\Support\SectionTrait;

class TeamController extends Controller
{
    use SectionTrait;

    private const SECTION_NAME = 'People';

    private const HAS_IMAGE = true;
    private const IMAGE_FIELD_NAME = 'images';

    public static $indexFields;

    /**
     * Загрузка языковых значений/локализация
     */
    public static function boot(): void
    {
        self::$indexFields = [
            'name' => __('admin.section_fields.username'),
            'position' => __('admin.section_fields.position')
        ];
    }

    /**
     * Создание страницы
     * @param TeamAddRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(TeamAddRequest $request)
    {
        return $this->createElement($request);
    }

    /**
     * Изменение страницы
     * @param TeamEditRequest $request
     * @param                 $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TeamEditRequest $request, $id)
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
        return People::find($id);
    }
}
