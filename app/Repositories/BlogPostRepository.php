<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\BlogPost as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BlogPostRepository
 * 
 * @package App\Repositories
 */
class BlogPostRepository extends CoreRepository //implements Interface
{
  /**
   * @return string
   */
  public function getModelClass()
  {
    return Model::class;
  }
  
  /**
   * Получить модель для редактирования в админке
   * 
   * @param integer $id
   * 
   * @return Model
   */
  public function getEdit($id)
  {
    return $this->startConditions()->find($id);
  }

  /**
   * Получить список акатегорий для вывода в выпадающем списке
   * 
   * @return Collection
   */
  public function getForCombobox()
  { 
    /* OLD
            //return $this->startConditions()->all();
    */
    

    $columns = implode(', ', ['id', 'CONCAT (id, ". ", title) AS id_title']);

    /* OLD
      $result_1[] = $this->startConditions()->all();

      $result_2[] = $this
          ->startConditions()
          ->select('blog_categories.*', DB::raw('CONCAT(id, ". ", title) AS id_title'))
          ->toBase() //преобразует полученную коллекцию в STD_class
          ->get();

       $result[] = $this
        ->startConditions()
        // ->selectRaw(implode(', ', ['id', 'CONCAT (id, ". ", title) AS id_title']))
        ->selectRaw($collumns)
        ->toBase() //преобразует полученную коллекцию в STD_class
        ->get();

        dd([$result_1, $result_2, $result]);
    */
    
    $result = $this
        ->startConditions()
        ->selectRaw($columns) // ->selectRaw(implode(', ', ['id', 'CONCAT (id, ". ", title) AS id_title'])) 
        ->toBase() //преобразует полученную коллекцию в STD_class
        ->get();

    return $result;
  }

  /**
   * Получить все категории для вывода пагинатором
   * 
   * @param int|null $perPage
   * 
   * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
   */
  public function getAllWithPaginate($perPage = null)
  {
    // $columns = ['title', 'excerpt'];
    $columns = ['title', 'content_html'];

    $result = $this
          ->startConditions()
          ->select($columns)
          // ->first($columns)
          ->toBase()
          // уточнить что скрыто ***
          ->paginate($perPage);
          
    return $result;
  }
}




