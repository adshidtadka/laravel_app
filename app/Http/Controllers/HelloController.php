<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
   public function index(Request $request)
   {
      $items = DB::table('people')->get();
      return view('hello.index', ['items' => $items]);
   }

   public function post(Request $request)
   {
       $items = DB::select('select * from people');
       return view('hello.index', ['items' => $items]);
   }

   public function add(Request $request)
   {
       return view('hello.add');
   }

   public function create(Request $request)
   {
       $param = [
           'name' => $request->name,
           'mail' => $request->mail,
           'age' => $request->age,
       ];
       DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);
       return redirect('/hello');
   }

   public function edit(Request $request)
	{
	   $param = ['id' => $request->id];
	   $item = DB::select('select * from people where id = :id', $param);
	   return view('hello.edit', ['form' => $item[0]]);
	}
	
	public function update(Request $request)
	{
	   $param = [
	       'id' => $request->id,
	       'name' => $request->name,
	       'mail' => $request->mail,
	       'age' => $request->age,
	   ];
	   DB::update('update people set name =:name, mail = :mail, age = :age where id = :id', $param);
	   return redirect('/hello');
	}

	public function del(Request $request)
	{
	   $param = ['id' => $request->id];
	   $item = DB::select('select * from people where id = :id', $param);
	   return view('hello.del', ['form' => $item[0]]);
	}
	
	public function remove(Request $request)
	{
	   $param = ['id' => $request->id];
	   DB::delete('delete from people where id = :id', $param);
	   return redirect('/hello');
	}

	public function show(Request $request)
	{
	   $id = $request->id;
	   $item = DB::table('people')->where('id', $id)->first();
	   return view('hello.show', ['item' => $item]);
	}

}

// class HelloController extends Controller
// {
// 	// リスト2-7
// 	public function index() {

// 		return <<<EOF
// <html>
// <head>
// <title>Hello/Index</title>
// <style>
// body {font-size:16pt; color:#999; }
// h1 { font-size:100pt; text-align:right; color:#eee;
//    margin:-40px 0px -50px 0px; }
// </style>
// </head>
// <body>
//    <h1>Index</h1>
//    <p>これは、Helloコントローラのindexアクションです。</p>
// </body>
// </html>
// EOF;

//    }
// 

// リスト2-9
// class HelloController extends Controller
// {
  
//    public function index($id='noname', $pass='unknown') {

//       return <<<EOF
// <html>
// <head>
// <title>Hello/Index</title>
// <style>
// body {font-size:16pt; color:#999; }
// h1 { font-size:100pt; text-align:right; color:#eee;
//    margin:-40px 0px -50px 0px; }
// </style>
// </head>
// <body>
//    <h1>Index</h1>
//    <p>これは、Helloコントローラのindexアクションです。</p>
//    <ul>
//        <li>ID: {$id}</li>
//        <li>PASS: {$pass}</li>
//    </ul>
// </body>
// </html>
// EOF;

//    }
// }

// リスト2-11
// global $head, $style, $body, $end;
// $head = '<html><head>';
// $style = <<<EOF
// <style>
// body {font-size:16pt; color:#999; }
// h1 { font-size:100pt; text-align:right; color:#eee;
//    margin:-40px 0px -50px 0px; }
// </style>
// EOF;
// $body = '</head><body>';
// $end = '</body></head>';

// function tag($tag, $txt) {
//    return "<{$tag}>" . $txt . "</{$tag}>";
// }

// class HelloController extends Controller
// {
  
//    public function index() {
//        global $head, $style, $body, $end;
      
//        $html = $head . tag('title','Hello/Index') . $style . $body
//            . tag('h1','Index') . tag('p','this is Index page')
//            . '<a href="/hello/other">go to Other page</a>'
//            . $end;
//        return $html;
//    }

//    public function other() {
//        global $head, $style, $body, $end;
      
//        $html = $head . tag('title','Hello/Other') . $style . $body
//            . tag('h1','Other') . tag('p','this is Other page')
//            . $end;
//        return $html;
//    }

// }

// リスト2-13
// class HelloController extends Controller
// {
  
//    public function __invoke() {

//      return <<<EOF
// <html>
// <head>
// <title>Hello</title>
// <style>
// body {font-size:16pt; color:#999; }
// h1 { font-size:30pt; text-align:right; color:#eee;
//   margin:-15px 0px 0px 0px; }
// </style>
// </head>
// <body>
//   <h1>Single Action</h1>
//   <p>これは、シングルアクションコントローラのアクションです。</p>
// </body>
// </html>
// EOF;

//    }

// }