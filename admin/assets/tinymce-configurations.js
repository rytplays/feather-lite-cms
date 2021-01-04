var tinymce_configurations = 
{
    selector: 'textarea#i_post_content',
    menubar:false,
    statusbar: false,
    height : 300,
    contextmenu: false,
    formats: 
    {
        bold : {inline : 'b' },
    },
    external_plugins: 
    {
        'job': 'https://raw.githack.com/enouplus/tinymce-plugins/main/job.min.js',
    },
    plugins: "code autolink image link advlist lists textpattern table job fullscreen",
    toolbar: 'job formatselect bold italic forecolor backcolor removeformat | bullist numlist table | blockquote alignleft aligncenter alignright | link unlink  image code | fullscreen'
}