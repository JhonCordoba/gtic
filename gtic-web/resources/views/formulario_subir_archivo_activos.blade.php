<form enctype="multipart/form-data" method="post" action="subir_activos">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
    <input type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"  name="activos"/>
    <input type="submit" value="Subir" class="button" >
        
</form>