import {Bold, ClassicEditor, Essentials, Font, Italic, Paragraph} from "ckeditor5";
import "ckeditor5/ckeditor5.css";


document.addEventListener("DOMContentLoaded", () => {
    const editorElement = document.querySelector('#editor');

    if(editorElement){
        ClassicEditor.create(editorElement,{
            plugins:[Essentials,Bold,Italic,Font,Paragraph],
            toolbar:['bold','italic','fontColor','fontSize','fontFamily','|','undo','redo']
        })
            .catch(error => {
                console.error(error);
            });
    }
});