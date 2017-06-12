<!-- ini untuk posisi content -->
<div class="panel-content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-10 col-sm-10">
            <div class="panel panel-primary"><!--Panel -->
                <div class="panel-heading"><!--Panel Header -->
                    <span class="glyphicon glyphicon-dashboard"></span> Import File
                </div>
                <div class="panel-body"><!--Panel Body -->
                    <div class="col-sm-12">
                       <form enctype="multipart/form-data" method="post" role="form">
                            <div class="form-group">
                                <label for="exampleInputFile">File Upload</label>
                                <input type="file" name="file" id="file" size="150">
                                <p class="help-block">Only CSV File Import.</p>
                            </div>
                            <a href="#" class="btn btn-primary">Back</a>
                            <button type="submit" class="btn btn-primary" name="Import" value="Import">Upload</button>
                        </form>
                    </div>
                </div>