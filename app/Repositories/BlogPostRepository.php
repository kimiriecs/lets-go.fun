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
    

    $collumns = implode(', ', ['id', 'CONCAT (id, ". ", title) AS id_title']);

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
        ->selectRaw($collumns) // ->selectRaw(implode(', ', ['id', 'CONCAT (id, ". ", title) AS id_title'])) 
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
    $collumns = [
      'id',
      'title',
      'slug',
      'is_published',
      'published_at',
      'user_id', 
      'blog_category_id'];

    $result = $this
          ->startConditions()
          ->select($collumns)
          ->orderBy('id', 'DESC')
          ->with(['blog_category', 'user'])
          // ->with([
          //     'blog_category'=>function($query){
          //       $query = select('id', 'title');
          //     },
          //     'user:id,name'
          // ])
          ->paginate($perPage);
          
    return $result;
  }
}




