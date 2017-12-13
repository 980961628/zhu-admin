<?php
  namespace app\admin\controller;
  use think\Controller;
  use think\Request;
  use think\Db;
  class Index extends Controller{
    //控制器初始化
    public function _initialize(){
      echo 'init'."<hr/>";
    }
    public function test(){
//      return 'test';
      $this->redirect("admin/Index/a",['id'=>1]);
//      $this->error('error');
//      return 'admin/test';
//      return view("index");
    }
    public function a(){
      return 'aaa';
    }

    public function request($id){
      $request = request();
      echo 'domain:'.$request->domain()."<hr/>";
      echo 'domain:'.$request->baseFile()."<hr/>";
      echo 'domain:'.$request->url()."<hr/>";
      echo 'domain:'.$request->url(true)."<hr/>";
      echo 'domain:'.$request->root()."<hr/>";
      echo 'domain:'.$request->root(true)."<hr/>";
      echo 'domain:'.$request->pathinfo()."<hr/>";
      echo 'domain:'.$request->path()."<hr/>";
      echo 'domain:'.$request->ext()."<hr/>";

      echo $request->method()."<hr/>";
      echo $request->type()."<hr/>";
      echo $request->ip()."<hr/>";
      echo var_export($request->isAjax(), true)."<hr/>";
      dump($request->param());
      echo "<hr/>";
      echo input('get.id');
      echo $request->param('id');
      echo Request::instance()->get('id');
    }

    public function mysql(){
      $data = Db::table('shop')->where('cid',0)->find();
      var_dump($data);
      $shop = db('shop')->where('id',31)->find();
      var_dump($shop);

      echo '<hr/>';
      $name = Db::table('shop')->where('id',31)->value('name');
      echo $name;
      echo '<hr/>';

      $col = Db::table('shop')->where('id',31)->column('name','price');
      var_dump($col);

      //添加数据
      $data = ['name'=>'朱哥哥','age'=>18];
      $res = Db::table('tp5_test')->insert($data);
      echo $res;
      echo Db::table('tp5_test')->getLastInsID();
      echo Db::table('tp5_test')->count();
      echo Db::table('tp5_test')->max('id');
//      $data = Db::query('select * from shop');
//      $data = Db::query('select shop.*,category.name as cname from shop,category WHERE shop.cid=category.id');
//      $data = Db::query('select shop.*,category.name as cname from shop LEFT JOIN category ON shop.cid=category.id');
//      $data = Db::query('select shop.*,category.name as cname from shop LEFT JOIN category ON shop.cid=category.id');
      $data = Db::table('shop')
          ->join(['category'=>'cname'],'shop.cid=category.id','left')
          ->select();
//      var_dump($data);
//      $data = Db::query('select a.*,b.name as cname from a,b WHERE a.cid=b.id');

      $data=Db::table('a')
          ->join('b','a.cid=b.id')
          ->select();

      var_dump($data);

    }

  }