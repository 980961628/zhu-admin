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
          'pid' => $request->param('pid'),
          'created_time' => time()
      ];
      if (!$validate->check($data)) {
        $result['code'] = 1;
        $result['msg'] = $validate->getError();
      } else {
        $category = new Category();
        $category->data($data);
        if ($category->save()) {
          $result['code'] = 0;
          $result['msg'] = "发布成功";
        } else {
          $result['code'] = 1;
          $result['msg'] = "发布失败";
        }
      }
      echo json_encode($result);
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
          'cid' => $request->param('cid'),
          'created_time' => time()
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