<form action="restTest.create" method="post">

  @csrf
    
  <label for="title"></label>  
  <input type="text" name="title" id="title">

  <label for="slug"></label>  
  <input type="text" name="slug" id="slug">
  
  <label for="blog_category_id"></label>  
  <input type="text" name="blog_category_id" id="blog_category_id">

  <label for="excerpt"></label>  
  <input type="textarea" name="excerpt" id="excerpt">

  <label for="content_raw"></label>  
  <input type="textarea" name="content_raw" id="content_raw">

  <select name="blog_category_id" id="blog_category_id">

    @forech($categories as $category)
      <option value="{{ $category }}"></option>
    @endforech

    <!-- <option value="#1"></option>
    <option value="#2"></option>
    <option value="#3"></option>
    <option value="#4"></option>
    <option value="#5"></option>
    <option value="#6"></option>
    <option value="#7"></option>
    <option value="#8"></option>
    <option value="#9"></option>
    <option value="#10"></option> -->
    
  </select>
  
</form>
