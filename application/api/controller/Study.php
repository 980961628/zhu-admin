<?php
  namespace app\api\controller;
  use think\Controller;
  use think\Request;
  use think\Db;
  use think\Validate;
  use app\api\model\Category;
  use app\api\model\Node;
  class Study extends Controller
  {

    public function test()
    {
      echo 'test';
    }

    /**
     * 添加分类
     * Method post
     * @param name
     * @param pid
     */
    public function category_add()
    {
      $request = Request::instance();
      $validate = new Validate(
          [
              'name|分类名称' => "require|max:12",
              'pid|父id' => "require|number"
          ]
      );
      $data = [
          'name' => $request->param('name'),
          'pid' => $request->param('pid')
      ];
      if (!$validate->check($data)) {
        $result['code'] = 1;
        $result['msg'] = $validate->getError();
      } else {
        $category = new Category();
        //检测是否已存在
        $isExist = $category->where('name',$data['name'])->find();
        if($isExist){
          $result['code'] = 1;
          $result['msg'] = "发布失败,分类名已存在";
        }else{
          $category->data($data);
          if ($category->save()) {
            $result['code'] = 0;
            $result['msg'] = "发布成功";
          } else {
            $result['code'] = 1;
            $result['msg'] = "发布失败";
          }
        }

      }
      echo json_encode($result);
    }

    /**
     * 后台添加分类模块
     *
     */
    public function category_list(){

      $category = new Category();
      $request = Request::instance();
      $pid = $request->param('pid');
      $type = $request->param('type');
      $result=[];
      if(!$type){

        if( $pid || $pid === "0"){
          $list = $category->where('pid',$pid)->select();
        }else{
          $list = $category->all();
        }
        $data=[];
        foreach($list as $key=>$cate){
          $data[] = [
            'name'=> $cate->name,
            'pid' => $cate->pid,
            'id' => $cate->id
          ];
        }
        $result['code'] = 0;
        $result['data']=$data;
      }else if($type == 1){
        $list = $category->where('pid',0)->select();
        $data=[];
        foreach($list as $key=>$cate){
          $child_list = $category->where('pid',$cate->id)->select();
          $child_data = [];
          foreach($child_list as $child){
            $child_data[]=[
                'name'=> $child->name,
                'pid' => $child->pid,
                'id' => $child->id
            ];
          }
          $data[] = [
              'name'=> $cate->name,
              'pid' => $cate->pid,
              'id' => $cate->id,
              'child_data'=>$child_data
          ];
        }
        $result['code'] = 0;
        $result['data']=$data;
      }
      return json_encode($result);
    }

    /**
     * 删除分类
     */
    public function category_delete(){
      $request = Request::instance();
      $id = $request->param('id');
      $category = new Category();
      $cate = $category->where('id',$id)->find();
      if(!$cate){
        $result['code'] = 1;
        $result['mgs'] = '删除失败,分类不存在';
      }else{
        if($cate->pid == 0){
          $category->where('pid',$id)->delete();
        }
        $res = $category->where('id',$id)->delete();
        $result = [];
        if($res){
          $result['code'] = 0;
          $result['msg'] = '删除成功';
        }else{
          $result['code'] = 1;
          $result['mgs'] = '删除失败';
        }
      }
      return json_encode($result);
    }
    /**
     * 编辑分类
     */
    public function category_update(){
      $request = Request::instance();
      $id = $request->param('id');
      $name = $request->param('name');
      $result = [];
      if($id){
        $category = new Category();
        $res = $category->where('id',$id)->update(
          [ 'name' => $name ]
        );
        if($res){
          $result['code'] = 0;
          $result['msg'] = '更新成功';
        }else{
          $result['code'] = 1;
          $result['msg'] = '更新失败';
        }
      }
      return json_encode($result);

    }



    /**
     * 添加node
     * Method post
     * @param title
     * @param content
     */
    public function node_add()
    {
      $request = Request::instance();
      $validate = new Validate([
          'title|标题' => "require|max:30",
          'content|内容' => "require",
          'content|分类' => "require"
      ]);
      $data = [
          'title' => $request->param('title'),
          'content' => $request->param('content'),
          'cid' => $request->param('cid')
      ];
      if (!$validate->check($data)) {
        $result['code'] = 1;
        $result['msg'] = $validate->getError();
        echo json_encode($result);
      } else {
        $node = new Node();
        $node->data($data);
        if ($node->save()) {
          $result['code'] = 0;
          $result['msg'] = "发布成功";
        } else {
          $result['code'] = 1;
          $result['msg'] = "发布失败";
        }
        return json_encode($result);
      }


      /**
       * 获取node列表
       *
       */


    }

    public function node_list(){
      $node = new Node();
      $dataAll = $node::all();
      $data=[];
      foreach($dataAll as $key => $item){
        $data[]=[
          'title' => $item->title,
          'content' => $item->content
        ];
      }

      var_dump($data);
    }
  }