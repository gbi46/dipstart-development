<script src="/js/zakaz_parts.js"></script>
<script src="/js/jquery.tmpl.min.js"></script>
<div id="zakaz_parts">
    <script class="zakazFileTemplate" type="text/x-jquery-tmpl">
        {{each files}}
            <li>
                <a href="/uploads/additions/${part_id}/${file_name}">${orig_name}</a> Комментарий:<input type="text" class="files_comment_${id}" value="${comment}"><button class='save_files_comment' type='submit' value='${id}'>Сохранить</button>
            </li>
        {{/each}}
    </script>
    <!-- Шаблон отображения списка частей -->
    <script class="zakazPartTemplate" type="text/x-jquery-tmpl">
        <table style="background-color:grey;" >
        <tr>
            <td>
                id: '${id}'
            </td>
            <td>
                date: '${date}'
            </td>
            <td>
                title: '${title}'
            </td>
        </tr>
        <tr>
            <td class='files_to_${id}'>
                
            </td>
            <td>
                comment: '${comment}'
            </td>
            <td>
                author: '${author_id}'
            </td>
        </tr>
        </table>
    </script>
    <h4>Части</h4>
    <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
        array(
            'id'=>'EAjaxUpload',
            'config'=>array(
                'action'=>$this->createUrl('zakazParts/upload/'),
                'template'=>'<div class="qq-uploader"><div class="qq-upload-drop-area"><span>Drop files here to upload</span></div><div class="qq-upload-button">Upload a file</div><ul class="qq-upload-list"></ul></div>',
                'debug'=>false,
                'allowedExtensions'=>array('jpg', 'gif', 'txt', 'doc', 'docx'),
                'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                'minSizeLimit'=>10,// minimum file size in bytes
                'onComplete'=>"js:function(id, fileName, responseJSON){
                                 alert(fileName + ' in ' + id);
                             }"
            )
        ));?>
    <div class="show_parts">
        
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var zakazPartsView = new ZakazPartsView(
            <?php echo $orderId;?>
        );
    });
</script>