<!-- Edit Modal-->

<div class="modal fade bd-example-modal-lg" id="edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
                <div class="modal-header">
				<h5 class="modal-title float-left" id="exampleModalLabel">Update Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				
                </div>
                <div class="modal-body">
				<form class="form-horizontal row-fluid"  method="POST" >
				<div class="container-fluid">
				
				<input type="hidden" style="width:350px;" class="form-control" name="idd" id="idd" >
					

						

					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Category :</span>
						<input type="text" style="width:350px;" class="form-control" name="category" id="ecategory" >
					</div>
					
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Description :</span>
						
						<textarea style="width:350px;" class=" form-control"  name="desc" rows="4" cols="50" id="edesc"></textarea>
					</div>
					

					
					
				
				
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <!-- <button type="button" name="update" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> </i> Update</button> -->
					<button   name="update" class="btn btn-success" data-toggle="modal" data-target="#modal-default" >Save</button>
                </div>
				</form>
            </div>
        </div>
    </div>
	</div>
<!-- /.modal -->