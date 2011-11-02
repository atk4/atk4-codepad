<?php
class SourceViewer extends View {
    public $relative;
    public $file;
    public $type;

    function load($type,$file){
        $this->file=$this->api->locatePath($type,$file);
        $this->relative=$this->api->locate($type,$file);
        $this->type=$type;

        $this->add('H3')->set('Source located: '.preg_replace('|.*codepad/|','',$this->file));
        $t=$this->add('Text');
        $t->set(highlight_string($f=file_get_contents($this->file),true));

        return $this;
    }
}
