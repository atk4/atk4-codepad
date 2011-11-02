<?php
class SourceViewer extends View {
    public $relative;
    public $file;
    public $type;

    function load($type,$file){
        $this->file=$this->api->locatePath($type,$file);
        $this->relative=$this->api->locate($type,$file);
        $this->type=$type;

        $h=$this->add('H3');
        $t=$this->add('Text');

        $f=file_get_contents($this->file);
        $t->set(highlight_string($f,true));
        $f=preg_replace('|/\*.*?\*/|s','',$f);
        $f=preg_replace('/^\s*$/ms','',$f);
        $f=preg_replace("/\n\n*/s","\n",$f);

        $h->set('Source located: '.preg_replace('|.*codepad/|','',$this->file).' ('.count(explode("\n",$f)).' effective lines)');

        return $this;
    }
}
