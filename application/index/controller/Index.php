<?php
namespace app\index\controller;
// use test;
use app\common\service\TestNotify;
use app\index\model\Article;
use app\index\model\Blog;
use app\index\model\Comment;
use app\index\model\Content;
use app\index\model\Course;
use app\index\model\DailySet;
use app\index\model\Profile;
use app\index\model\Student;
use EasyWeChat\Payment\Payment;
use GuzzleHttp\Client;
use think\Cache;
use think\Config;
use think\Controller;
use think\Cookie;
use think\db\Query;
use think\Exception;
use think\Log;
use think\Request;
use app\index\model\User;
use think\Session;
use think\Validate;
use think\Db;
use myTest;
use Payment\Common\PayException;//支付用
use Payment\Client\Charge;
use Payment\Client\Notify;
use Payment\Config as PaymentConfig;
// use Test;
class Index extends Base
{
    /**对数据库操作的说明：
     *查询使用闭包的方式查询
     */
    //依赖注入(这是一种设计模式),不继承Controller时使用
    //官方文档的请求->依赖注入:解决了向类中的方法传入对象的问题
//     protected $request;
//     public function __construct(Request $request){
//          //$request = new Request; //使用上面的参数相当于使用了这个
//         $this->request = $request;
//         halt($this->request);
//     }

    /**_initialize的流程理解：
     * _initialize()方法在所有方法前先执行。执行操作方法时，先实例化Index.php文件下的Index类，Index继承Base类，Base继承Controller类
     * 所以文件的执行顺序为index->base->Controller,它的基类初始化函数__construct会执行，
     * 又因为基类存在_initialize()方法，基类的会被覆盖
     */
    public function _initialize()
    {
//        echo $this->request->path();
        parent::_initialize();
    }

    public function ceshi()
    {
        //extend会自动读取文件下的扩展
    	$test = new \test\Test();  //命名空间下的自动注册没有use时需要'\'
    	echo $test->sayHello();
    	//自定义的
    	$myTest = new myTest\myTest();  //命名空间下的手动注册有use不需要最前面的\ 在应用配置文件配置
    	echo $myTest->sayBey();
    	//echo 'app\\index\\controller';
    	dump(\test\Test::class);//返回完整的类名字符串
        dump(\think\Config::get('ceshi.abc'));  //扩展配置测试
        dump(\think\Config::get('queue.connector'));  //扩展配置测试
        return config('app_namespace');
    }


    public function index()
    {
        $breadcrumb = '主页';
        $this->view->breadcrumb = $breadcrumb;

//        dump($this->request->param());die;
//        dump(request()->siteName);//注入属性
//        dump($this->request->user(1));die;//注入方法
        //行为侦听
        $params = ['a' => '我是自定义的行为'];
//        \think\Hook::listen('test1',$params,[],true);//这也可以写在前端上
//        \think\Hook::listen('test2',$params,[],true);//这也可以写在前端上
//        dump(session(''));//重定向测试
        $user = model('User');
        //数据库注册事件
        Query::event('before_select',function($options,$query){
            // 事件处理
//            dump($query);
//            echo '<script>alert("我是数据库事件处理");</script>';
//            return false;//(没有作用)
        });
          //数据库查出来的对象能像数组一样使用
//        //获取器还可以定义数据表中不存在的字段(getTitleTextAttr)
//        $user = User::get(1);  //取出主键为1的数据等同于get(['id'=>1]) $user是个对象 
//        用模型层查询处理得到的是对象,toArray转化为数组,
//        用Db类select,find得到的是数组,可以修改数据库配置collection输出为对象，模型的区别还是很大
//        $user->title_text = -1;
//        echo $user->title_text;DIE; // 例如输出“删除”
        $request = Request::instance();
        if($kw = $request->param('kw')){
            $condition['name'] = ['like','%'."{$kw}".'%'];
        }
        $condition['status'] = ['=',1];
//        $sql = Db::name('user')->where($condition)->select();
//        halt($sql);
//        $sql = $user->where($condition)->order('id desc')->whereTime('create_time','-50 day')->select();
//        $sql->hidden(['create_time','update_time']);
//        return json($sql);
//        $sql = collection($sql)->toArray();
//        halt($sql);
//        $list = User::all([127,128]);
//        $list = $list->toArray();
//        halt($list);
        //带条件翻页(paginate方法会获取当前页)
        $list = $user->where($condition)->order('id desc')->paginate(3,false,['query'=>$request->param()]);
//        $users = Db::name('user')->where('user_email','like',"{$params['email']}%")->paginate(10);
//        halt($list[0]);
        // 获取分页显示
        $page = $list->render();
        // 模板变量赋值
        $this->assign('list', $list);
        // $this->assign('title', 'sb');
        $this->assign('page', $page);
        return $this->fetch();
        //模板赋值，直接输出内容(可以用于ajax)
//        $content = '{$name}-{$email}';
//        return $this->display($content, [
//            'name'  => 'ThinkPHP',
//            'email' => 'thinkphp@qq.com'
//        ]);

    }

    public function checkcode()
    {
        $code=input('yanzhengma');
        if(!captcha_check($code))
        {
            echo "验证码错误！";
        } else {
            echo "验证通过！";
        }
    }

    /**添加注释后throw没有下划线
     * @return mixed
     * @throws Exception
     * @throws \think\exception\PDOException
     */
    public function add()
    {
        if(Request::instance()->isPost()){  //判断是否是POST数据(调用静态方法不用实例化或者$this->request->isPost())
            //dump(input('post.'));die;

            $request = Request::instance();
//             $data = $request->param();
            $data = input('post.');  //接收POST数据
            // halt($data);
            //验证
            $validate = validate('User');  //助手函数实例化Validate类
            if(!$validate->scene('add')->check($data)) {  //批量验证一次性获得所有的错误消息有另一个方法
                $this->error($validate->getError());
            }

            //对接收的数据统一处理的方法
//            $validate->scene('add');
//            if(!$validate->goCheck()) {
//                $this->error($validate->getError());
//            }
//            //验证的另一种方法
//            $result = $this->validate($data,'User');
//            if(true !== $result){
//                // 验证失败 输出错误信息
//                dump($result);die;
//            }
            //静态调用验证  ?


            $user = model('User');

            // 模型对象赋值
            $user->data($data);
            $user->info = ['a'=>1,'b'=>2];  //测试字段设置类型自动转换(要有模型支持)
            // 启动事务
            Db::startTrans();
            try{
                // 过滤post数组中的非数据表字段数据
                $user->allowField(true)->save();//save($data)就不需要模型的$auto

//                1/0;//测试事务(故意写错)
                //strtotime('today')//这一天的凌晨零点
                $today_before = strtotime('today');
                $today = strtotime("1 day");
                $date = Db::name('dailySet')
                    ->where('date','>=',$today_before)
                    ->find();
                $daily = new DailySet();
                if ($date){
                    //有值,更新
//                    $daily->data();
                    $daily->save(['add_count' => ['exp','add_count+1']],['id' =>  $date['id']]);
                }else{
                    //为null,新增
                    $daily->save([
                        'date' => $today_before,
                        'add_count' => 1
                    ]);
                }
                //提交事务
                Db::commit();
            }catch (Exception $e){
                //事务回滚
                Db::rollback();
                throw new Exception('添加失败！');
            }

            // 获取自增ID
            $id =  $user->id;
//            unset($data['repassword']);  //或者用model('User')的方法就不用这样写因为模型有方法去取不存在的字段
//            $id = Db::name('user')->insertGetId($data);  //数据库操作得到自增id
            if($id){
                $sql = Db::table('tp_user')
                    ->where('id', $id)
                    ->update([
                        'login_time'  => ['exp','now()'],  //表达式给值 login_time = now()
                        'login_times' => ['exp','login_times+1'],
                    ]);
//                halt($sql);//用tp自带的调试器查看sql
                $this->success('添加成功','index/index');
//                 return $this->fetch(); //测试当前对象是否还保留着request对象的属性(测试的是搜索)前端不能使用$this要使用系统变量
//                $this->success('添加成功','index/index',['cate'=>45],3);//测试带参数ajax
            }

        }
        return $this->fetch();

    }

    public function upload()
    {

    }

    /**
     * 可以用来做点击量
     * @return [type] [description]
     */
    public function see()
    {
        //数组方式和闭包方式的数据查询的区别在于，数组方式只能定义查询条件，闭包方式可以支持更多的连贯操作，
        //包括排序、数量限制等。
        $request = Request::instance();
        $id = $request->param('id');
             $data = input('post.');  //接收POST数据
        // $result = User::where('id', 49);
        // 这里的闭包函数方法能更新一个字段,还能返回对象(???为什么不是当前id的对象,5.1的版本才可以???)
        $result = User::get(function($query) use ($id) {
            $query->where('id','=',$id)->setInc('score');//这里能得到对象,不过是id为1的对象,加了find()就是当前要查找的对象
        })->find(['id'=>$id]);//添加了这个下面的就不用查询了(5.1版本不用添加???)
        if (empty($result)) {
            abort(404, '文章不存在!');
        }
//        halt($result);
        // $result = User::get($id);
        //测试重定向,不继承Controller类时，可以使用(隐式传参是保存的session值,只能使用一次，传过去之后刷新就不存在了)
//        return redirect('admin/index/index',['cate_id' => 2], 302, ['data' => 'hello'])->remember();
        //继承时使用
//        return $this->redirect('index/index', ['cate_id' => 2], 302, ['data' => 'hello']);
        return $this->fetch('edit-see',['result'=>$result]);

    }

    public function chart(){
//        halt(date("Y/m/d H:i:s",strtotime("1 day") ));
        if($this->request->isPost()) {
            $request = Request::instance();
            $date_from = $request->param("date_from", strtotime("-30 days"));
//        $date_from = $request->param("date_from",date("Y/m/d H:i:s",strtotime("-30 days") ));
            $date_to = $request->param("date_to", time());
//        $date_to = $request->param("date_to", date("Y/m/d H:i:s" ) );
            $date['date'] = ['>=', $date_from];
            $date['date'] = ['<=', $date_to];
            //$res = DailySet::all($date);//[{},{}...,{}]
            $res = DailySet::all(function ($query) use ($date) {
                $query->where($date)->order('id asc');
            });
            $data = [
                'categories' => [], //规定x轴的开始
                'series' => [
                    [
                        'name' => '今日新增',
                        'data' => []
                    ],
//                [
//                    'name' => 'xx总数',
//                    'data' => [2,5,8,9]
//                ]
                ]
            ];
            foreach ($res as $_item) {
                $data['categories'][] = $_item['date'];//模型层的数据可以向数组一样取值
                $data['series'][0]['data'][] = $_item['add_count'];
            }
            //Config::set('default_ajax_return','html'); //配置ajax默认的返回格式,两边要相同数据类型
//            return $this->fetch('login');//这样可以用于分页无刷新
            //exit(json_encode(['data'=>$data]));
            $this->result($data,200,'成功');//只能ajax访问得到数据，网页访问得不到数据
        }
    }

    public function delete(){
        $id = $this->request->param('id');//param为空时得到的是数组类型(显示的是字符串类型)
        try{
//          Db::name('user')->where('id',$id)->delete();//fetchSql(true)查看sql
            Db::name('user')->delete($id);
            //没写完
        }catch (Exception $e){
            throw new Exception('错误！');
        }
        $this->result('',200,'删除成功');

    }

    public function rollback(){

    }
    //关联测试一对一
    public function relationOne(){
        //关联新增
        //$user = User::get(85);
        // 如果还没有关联数据 则进行新增(可以这样使用判断主表是不是存在数据，在来对从表进行新增或更新选择)
        //新增要使用对应的方法名(有括号)
//        $user->profiles()->save(['nickname' => 'thinkphp85']);
//        $pro = Profile::get(10);
//        $pro->phone()->save(['phone' => '151545444']);
        //关联更新
//        $user = User::get(88);
//        $user->profiles->nickname = 'thinkphp.com';
//        $user->profiles->save(); // 或者$user->profile->save(['nickname' => 'thinkphp.com']);
        //关联查找
//        $list = User::all(88,'profiles');//关联查找,查找多个
        //网页的写法
//        foreach($list as $user){
//            // 获取用户关联的profile模型数据
//            dump($user->profiles->nickname);
//        }
        //关联删除
//        $user = User::get(88);
//        // 删除当前及关联模型的数据
//        $user->together('profiles')->delete();

        //嵌套预加载
//        $list = User::all(['status'=>['=',1]],'profiles.phone');//查找全部
        //$list = User::with(['profiles'=>['phone']])->where(['status'=>['=',1]])->select();//嵌套预加载()查询User对应的全部关联

        $list = User::field('id,name')//查询User对应的全部关联,并且关联的输出按条件筛选(测试闭包)
            ->with(['profiles'=>function($query){$query->where(['user_id'=>['=',85]]);},'profiles.phone'])->where(['status'=>['=',1]])->select([85,86,87]);

//        //网页的写法
//        foreach($list as $user){
//            // 获取用户关联的profile模型数据
//            dump($user->profiles->phone->toArray());
////            dump($user->toArray());
//        }
        dump(collection($list)->toArray());//代替上面的循环
        //api接口返回的数据写法(直接给客户端)
//        return json($list);//会把关联表的字段添加到父模型中{"name":xxx,...,"phone":xxx};对应上面的闭包


        //$user = User::get(88);
        // 输出Profile关联模型的email属性
        //根据定义的方法
//        dump($user->profiles);    // 获取动态属性
//        echo $user->profiles->nickname;
         //$user;
        //测试关联自动写入
//        $blog = new Blog();
//        $blog->name = 'thinkphp';
//        $blog->title = 'ThinkPHP5关联实例';
//        $content = new Content();
//        $content->data = '实例内容';
//        //contents对应的是模型的方法
//        $blog->contents = $content;
//        $blog->together('contents')->save();
        //测试查询
//        $blog = Blog::get(10);
//        echo $blog->contents->data;


    }

    //一对多
    public function hasMany(){
        //关联新增
        $article = Article::get(1);//Article::get(1,'comments');
//        // 增加一个关联数据
//        $article->comments()->save(['content'=>'TEXT']);//新增一个回复
        // 批量增加关联数据
//        $article->comments()->saveAll([
//            ['content'=>'thinkphp'],
//            ['content'=>'onethink'],
//        ]);
         //查询文章的所有评论
        $comments = $article->comments;
        foreach ($comments as $k=>$comment){
            //当前文章的所有评论信息
            dump($comment->content);
            //循环删除所有评论
//            $article->comments()->delete();
        }
        //查询文章的所有评论(另一种方法多用于api接口)
        $map['id'] = 1;
        $obj       = new Article();
        $data      = $obj->CommentsList($map);
        //dump($data);
        dump($data->toArray());
        //删除当前文章
//        $article->delete();
        //根据评论找到文章
//        $comment = Comment::get(1,'article');
//        dump($comment->article->content);
        //关联查询
        //我们可以通过下面的方式获取关联数据
//        $article = Article::get(1);
//        //获取文章的所有评论
//        dump($article->comments);
//        // 也可以进行条件搜索
//        dump($article->comments()->where('status',1)->select());
//        根据关联条件查询
//        可以根据关联条件来查询当前模型对象数据，例如：
//
//        // 查询评论超过3个的文章
//        $list = Article::has('comments','>',3)->select();
//        // 查询评论状态正常的文章
//        $list = Article::hasWhere('comments',['status'=>1])->select();

    }

    //多对多
    public function belongsToMany(){
        //关联新增
        //为当前学生新增课程并且添加新的课程(如果课程表里面没有该课程,会在课程表里面新增该课程)--------
//        $student=Student::get(1);
//        //给关联表 course 新增一条 name 数据// 增加关联数据 会自动写入中间表数据
//        $res= $student->course()->save(['name'=>'化学']);

        //查询
//        $student=Student::get(1);
//        dump($student->course);//当前学生的所有课程

        //只新增中间表数据，可以使用 ----------------
        //$student = Student::get(1);
        // 仅增加关联的中间表数据
//        $student->course()->save(6);//save()里面的参数是course表的主键
        // 或者()
//        $course = course::get(5);
//        $student->course()->save($course);
        //或者
//        $student->course()->attach(3);
        // 批量增加关联数据
        //$student->course()->saveAll([1,2,3]);

        //单独更新中间表数据，可以使用：-----------------
        //更新中间表数据
//        $student = Student::get(1);//要更新的对象
//        // 增加关联的中间表数据
//        $student->course()->attach(2);//参数为要替换成关联表对应的主键
//        // 传入中间表的额外属性
//        $student->course()->attach(1,['remark'=>'test']);//没有额外属性用上面的
//        // 删除中间表数据
//        $student->course()->detach([5]);//参数为被替换的关联表的主键


        //删除中间表数据
//        $student = Student::get(3);   //要删除的对象(参数为主键)
//        $student->course()->detach([3]);    //要删除的关联表(参数为主键)

        //取数据
        $course=Course::get(1);//$course的对象中存在Course类的方法
        //halt($course);
        $students = $course->student;
        //$course->hasCourse(1);//测试关联之后有条件的调用
//        foreach ($course as $stu){
//            dump($stu->toArray());
//        }
//        dump($students);//得到的是数组对象
//        dump($course);//得到的是对象
//        //数组转换为数据集对象
//        dump(collection($students));//对象之后就能使用方法了
        dump(collection($students)->toArray());

    }

    public function login(){
//
//        $data=['id'=>'ygy','hyu'=>'uiv'];
//        dump($a =cookie('name',$data));
        //dump(session('name',$a));
//        dump(\cookie('remember_me'));
        if ($this->getCookie()) {
            $this->redirect('index/index');
        }
//        if(!Session::has('userinfo') && Cookie::has('remember_me')){
//                $this->redirect('index/index');
//        }
//        if(Session::has('userinfo')){
//            $this->redirect('index/index');
//        }
        if ($this->request->isPost()) {
            $data = $this->request->param();
//            dump($data);
            if ($this->checkLogin($data)) {

                $this->redirect('index/index');
            }else{
                //用户名数据库比对错误返回信息
            }

        }
        return $this->fetch('login');
    }

    public function logout(){
        Session::clear();
        Cookie::clear();
        $this->redirect('index/login');
    }

    //支付宝扫码支付测试
    public function pay(){
        // 订单信息
        $orderNo = time() . rand(1000, 9999);
        $payData = [
            'body'    => 'ali web pay',
            'subject'    => '测试支付宝电脑网站支付（即时到账）',
            'order_no'    => $orderNo,
            'timeout_express' => time() + 600,// 表示必须 600s 内付款
            'amount'    => '0.01',// 单位为元 ,最小为0.01
            'return_param' => '123123',
            // 'client_ip' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1',// 客户地址
            'goods_type' => '1',// 0—虚拟类商品，1—实物类商品
            'store_id' => '',

            // 说明地址：https://doc.open.alipay.com/doc2/detail.htm?treeId=270&articleId=105901&docType=1
            // 建议什么也不填
            'qr_mod' => '',
        ];

        try {
            $url = Charge::run(PaymentConfig::ALI_CHANNEL_WEB, config('ali'), $payData);
        } catch (PayException $e) {
            echo $e->errorMessage();
            exit;
        }
//        echo $url;
//        header('Location:' . $url);
        $this->redirect($url);



    }

    //第三方支付回调处理
    public function notify(){
        $from = $this->request->param('from');
        Log::record($from,'from');
        $from = isset($from)? $from : 'ali';
        $callback = new TestNotify();//回调数据处理类
        if($from === 'ali'){
            $config = config('ali');
            $type = 'ali_charge';
        }
//        $log = @file_get_contents('php://input');//查看回调的原始信息
//        Log::record($_POST,'$_POST');//记录回调的$_POST信息
//        Log::record($log,'opt');//记录回调的原始信息


        try {
            //$retData = Notify::getNotifyData($type, $config);// 获取第三方的原始数据，未进行签名检查
//            dump($retData);die;
            $ret = Notify::run($type, $config, $callback);// 处理回调，内部进行了签名检查
        } catch (PayException $e) {
            echo $e->errorMessage();
            exit;
        }
        Log::record($ret,'测试结果');

        echo $ret;//成功返回 success 失败返回 fail
        exit;
    }


}
