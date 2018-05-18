<?php 
namespace Admin\products;
use Admin;
?>

<div class="box-header">
  <h3 class="box-title">all products</h3>
</div>

<div class="box-body">
	<table class="table table-bordered text-center">
		<tr>
			<th>#</th>
			<th>name</th>
			<th>price</th>
			<th>category</th>
			<th>brand</th>
			<th>action</th>
		</tr>
		<tr>
			<td>'.$obj->id.'</td>
			<td>'.$obj->title.'</td>
			<td>$'.$obj->price.'</td>
			<td>'.$category->title.'</td>
			<td>'.$brand->title.'</td>
			<td ><a href="?product='.$obj->id.'"><i class="fa fa-pencil"></i></a> <a href="?del_product='.$obj->id.'"><i class="fa fa-trash-o"></i></a></td>
		</tr>
	</table>
</div><!-- /.box-body -->