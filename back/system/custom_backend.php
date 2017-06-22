<div class="panel-content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-10 col-sm-10">
            <div class="panel panel-primary"><!--Panel -->
                <div class="panel-heading"><!--Panel Header -->
                    <span class="glyphicon glyphicon-dashboard"></span>Change BackEnd
                </div>
                <div class="panel-body"><!--Panel Body -->
                    <div class="col-sm-12">
		                    <form action="" method="post" enctype="multipart/form-data">
					                    <div class="form-group">
					                        <label>Header Image</label><br />
					                        <img src="../assets/img/<?php	echo $headim['header_image'];	?>" style="width:100%;" /><br /><br />
					                        <input type="file" name="fileimage" id="fileimage" value="" required/><br />
					                        <input type="submit" value="Submit" class="btn btn-default" name="up_header"/>
					                    </div>
					        </form>
		                    <hr />
		            <div class="col-sm-12">
							<form action="" method="post" enctype="multipart/form-data">
					                    <div class="form-group">
					                        <label>Footer Image</label><br />
					                        <img src="../assets/img/<?php	echo $footim['header_image'];	?>" style="width:100%;" /><br /><br />
					                        <input type="file" name="fileimage" id="fileimage" value="" required/><br />
											<input type="submit" value="Submit" class="btn btn-default" name="up_footer"/>
					                    </div>

					<div>
						<input type="button" align="left" value="Back" class="btn btn-success" onclick="history.go(-1)"/>
					</div>            
							
					         </form>
		            		</div>
		            	

		            </div>
		            </div>
		        </div>
		    </div>
		</div>
		</div>
	</div>
</div>		