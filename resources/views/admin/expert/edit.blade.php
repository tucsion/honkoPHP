
@extends('admin.layout')
@section('content')
<script type="text/javascript">
    document.title='专家信息修改';
</script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                医生管理
                <small>修改</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index') }}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="{{url('/admin/expert/index')}}">医生信息管理</a></li>
                <li class="active">修改页面</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
 
                <!-- right column -->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">修改页面</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session('user2edit'))
                        <div class="callout callout-info">
                                <ul>
                                   
                                        <li>{{ session('user2edit') }}</li>
                                    
                                </ul>
                            </div>
                            
                        @endif

                        <form class="form-horizontal" action="{{ url('/admin/expert/update') }}" method='post' >
                            {{ csrf_field() }}
                           <input type='hidden' name='id' value="{{ $data ->id}}">
                            <div class="box-body">
                             <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">姓名</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='relname' value="{{ $data -> relname }}" class="form-control" id="inputEmail3" placeholder="请输入真实有效的姓名">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">昵称</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='uname' value="{{ $data -> uname }}" class="form-control" id="inputEmail3" placeholder="请输入4到10位用户名">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">头像</label>
                                    <div class="col-sm-4">
                                    <input type="file" name='headurl' id="exampleInputFile">
                                    <p class="help-block">Please choose to upload the picture.</p>
                                   </div>
                                   
                                   <label for="inputEmail3" class="col-sm-2 control-label">头像查看</label>
                                    <input type="text" name='url' 
                                    @if($data -> headurl)
                                    value= "{{ $data -> headurl }}"
                                    @endif
                                    @if(!$data -> headurl)
                                    value = "还未上传正面照"
                                    @endif></input>
                                   <div class="col-sm-1">
                                  
                                    @if($data -> headurl )

                                    <a href="{{ url('/updates') }}/{{ $data -> headurl }}" target="_blank">
                                    @endif
                                    <img name='img' src="{{ url('/updates/picsee.png') }}"></a>
                                    </div>

                                   
                                  
                                    
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">手机号码</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='phone' value="{{ $data -> phone }}" class="form-control" id="inputEmail3" placeholder="请输入手机号码">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">邮箱</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='email' value="{{ $data -> email }}" class="form-control" id="inputEmail3" placeholder="请输入您的常用邮箱">
                                    </div>
                                </div> 
                              <div class="form-group">
                                 <label for="inputPassword3"  class="col-sm-2 control-label">性别</label>
                                <div class="col-sm-4">
                                <select name='sex' class='form-control'>
                                       <option value='0'>男</option>
                                       <option value="1">女</option>   
                                </select>
                                    
                                </div>
                                  <label for="inputEmail3" class="col-sm-2 control-label">证件号码</label>
                                    <div class="col-sm-4">
                                        <input type="text" name='cardno' value="{{ $data -> cardno }}" class="form-control" id="inputEmail3" placeholder="请输入身份证号码">

                                    </div>
                                    </div>
                                   <div class="form-group">
                <tr >
                <td width="72" bgcolor="#FFFFFF"><label for="inputEmail3" class="col-sm-2 control-label">出诊时间</label></td>
                <td colspan="2" bgcolor="#FFFFFF"></td>
               
                    <style>
                    table.visit {
                      background: #ccc !important;
                    }
                    
                    table.visit  td, table.visit  th {
                      background: #fff;
                      padding: 10px;
                    }
                    
                    table.visit  th {
                      font-size: 14px;
                      font-weight: 400px;
                      color: #333;
                    }
                    
                    table.visit  td {
                      font-size: 14px;
                      font-weight: 200px;
                      color: #666;
                    }
                    </style>
                    <table class="visit" ellpadding="2" cellspacing="1" >
                      <tr>
                        <th>周一</th>
                        <th>周二</th>
                        <th>周三</th>
                        <th>周四</th>
                        <th>周五</th>
                        <th>周六</th>
                        <th>周日</th>
                      </tr>
                      <tr>
                        @for ($i = 1; $i < 8; $i++)
                        <td><label><input type="checkbox" name="chuzhen[{{$i}}]" value="{{$i}}"
                          {{ $chuzhen = $data -> chuzhen}}
                          {{ $i = (string)$i }}
                          
                        @if(strpos($chuzhen,$i) !== false)
                       
                        checked ="checked"
                         
                        @endif

                         >上午</label></td>
                        @endfor
                      </tr>
                      <tr>
                        @for ($i = 1; $i < 8; $i++)
                          <td><label><input type="checkbox" name="chuzhen[{{($i+7)}}]" value='{{($i+7)}}'
                          
                          {{$t = $i +7 }}
                          {{$t = (string)$t}}
                         
                          @if(strpos($chuzhen,$t) !== false)
                        
                          checked ="checked"
                         
                          @endif
                          
                          >下午</label></td>
                        @endfor
                      </tr>
                    </table>
                    
                    </tr>
                                   </div>

                        <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">详细地址</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='address' value="{{ $data -> address }}" class="form-control" id="inputEmail3" placeholder="请输入详细地址">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">所属医院</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='major' value="{{ $data -> major }}" class="form-control" id="inputEmail3" placeholder="请输入所属医院">
                                    </div>
                                </div>
                                  <div class="form-group">
                                 <label for="inputPassword3"  class="col-sm-2 control-label">职称</label>
                               


                                <div class="col-sm-4">
                                <select name='sex' class='form-control'>
                                        @foreach($res as $zc)

                                       <option value="{{ $zc ->id }}">{{ $zc -> cate }}</option>
                                        @endforeach 

                                </select>
                                    
                                </div>
                                </div>
                                 <div class="form-group">
                <tr >
                <td width="72" bgcolor="#FFFFFF"><label for="inputEmail3" class="col-sm-2 control-label">科室</label></td>
                <td colspan="2" bgcolor="#FFFFFF"></td>
               
                    <style>
                    table.visit {
                      background: #ccc !important;
                    }
                    
                    table.visit  td, table.visit  th {
                      background: #fff;
                      padding: 10px;
                    }
                    
                    table.visit  th {
                      font-size: 14px;
                      font-weight: 400px;
                      color: #333;
                    }
                    
                    table.visit  td {
                      font-size: 14px;
                      font-weight: 200px;
                      color: #666;
                    }
                    </style>
                    <table class="visit" ellpadding="2" cellspacing="1" >
                      
                        @foreach($keshi as $keshi)
                        <td><label><input type="checkbox" name="keshi" value="{{$keshi -> id}}"
                        

                         >{{$keshi -> cate}}</label></td>
                        @endforeach
                      </tr>
                      
                    </table>
                    
                    </tr>
                                   </div>
                                    <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">擅长</label>
                                    <div class="col-sm-10">
                                        <textarea  name='shanchang' value="{{$data -> shanchang }}" class="form-control" id="inputEmail3" placeholder="请输入shanchang">
                                        </textarea>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">教育经历</label>
                                    <div class="col-sm-10">
                                        <textarea  name='jiaoyu' value="{{ $data -> jiaoyu}}" class="form-control" id="inputEmail3" >
                                        </textarea>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">简介</label>
                                    <div class="col-sm-10">
                                        <textarea  name='jianjie' value="{{ $data -> jianjie}}" class="form-control" id="inputEmail3" >
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">实名认证</label>
                                    <div class="col-sm-4">
                                    <input type="file" name='cardpic1' id="exampleInputFile">
                                    <p class="help-block">Please choose to upload the picture.职称证</p>
                                   </div>
                                   <label for="inputEmail3" class="col-sm-2 control-label">证件查看</label>
                                    <input type="text" name='pic1' 
                                    @if($data -> cardpic1)
                                    value= "{{ $data -> cardpic1 }}"
                                    @endif
                                    @if(!$data -> cardpic1)
                                    value = "还未上传职称证件"
                                    @endif></input>
                                   <div class="col-sm-1">
                                  
                                    @if($data -> cardpic1 )

                                    <a href="{{ url('/updates') }}/{{ $data -> cardpic1 }}" target="_blank">
                                    @endif
                                    <img name='img' src="{{ url('/updates/picsee.png') }}"></a>
                                    </div>
                                  
                                    
                                </div>

                     
                                <div class="form-group">
                                 <label for="inputPassword3"  class="col-sm-2 control-label">是否认证通过？</label>
                                <div class="col-sm-4">
                                 <select name='isrz' class='form-control'>
                                       <option value='0'>未认证</option>
                                       <option value="1">已认证</option>   
                                   </select>
                                    
                                </div>
                                </div>
                                <div class="form-group">
                                 <label for="inputPassword3"  class="col-sm-2 control-label">积分等级</label>
                               


                                <div class="col-sm-4">
                                <select name='sex' class='form-control'>
                                       <option value='0'>一级</option>
                                       <option value="1">二级</option> 
                                       <option value='2'>三级</option>
                                       <option value='3'>四级</option>
                                       <option value='4'>五级</option>

                                </select>
                                    
                                </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">密码</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='upwd' value="" class="form-control" id="inputEmail3" placeholder="请输入6到18位密码">

                                    <small style="color:red;">不修改请留空</small>
                                    
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">确认密码</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='repassword' value="" class="form-control" id="inputEmail3" placeholder="请再次输入新密码">

                                    </div>
                                </div>
      
                              </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button type="reset" class="btn btn-default">重置</button>
                                <button type="submit" class="btn btn-info pull-right">提交</button>
                            </div><!-- /.box-footer -->
                        </form>
                    </div><!-- /.box -->
                 
                </div><!--/.col (right) -->
            </div>   <!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection