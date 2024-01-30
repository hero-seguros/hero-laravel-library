<?php

namespace HeroSeguros\HeroLaravelLibrary\Abstractions;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    /** @var string  */
    protected string $modelClass = Model::class;

    /**
     * Retorna o modelo do Repositório
     * @return Model
     */
    public function getEmptyModel(): Model
    {
        return new $this->modelClass;
    }

    /**
     * Retorna um modelo a partir do ID
     * @param int $id
     * @return Model|null
     */
    public function getById(int $id): ?Model
    {
        $model = $this->modelClass::query()->where('id', $id)->first();

        return $model;
    }

    /**
     * Cria um novo registro a partir dos dados
     * @param array $data
     * @return Model
     */
    public function insert(array $data): Model
    {
        $model = $this->getEmptyModel();
        $model->fill($data);
        $model->save();

        return $model;
    }

    /**
     * Salva o Modelo
     * @param Model $model
     * @return Model
     */
    public function save(Model $model): Model
    {
        $model->save();

        return $model;
    }

    /**
     * Atualiza o Modelo
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function update(Model $model, array $data): Model
    {
        $model->update($data);

        return $model;
    }

    public function getAll(): Collection
    {
        return $this->modelClass->all();
    }
}