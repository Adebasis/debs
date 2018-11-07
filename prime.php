<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Consecutive prime sum Problem 50 </title>
</head>

<body>

<?php
  
  function extend($plist ,$a, $segSize) {
      
       $m=$a*$segSize;
       $l=$m-$segSize;
       $isPList=array();
        for($x=0;$x<$segSize;$x=$x+1)
        {
            
            $isPList[$x]=1;
        }
        $i=2;
        while($i<sizeof($plist))
        {
            $p=$plist[$i];
            $n=($l/$p);
            while($n*$p<$m)
            {
                if($n*$p>=$l)
                {
                    $isPList[$n*$p-$l]=0;
                }
                $n=$n+1;
            }
   
           
            $i=$i+1;
        }
        $ln=sizeof($plist);
        for($j=$l;$j<$m;$j=$j+1 )
        {
            if($isPList[$j-$l]){

                $plist[$ln]=$j;
                $ln=$ln+1;
            }
        }
        return $plist;
  }
  function  Prime($delta , $size){
        $plist=array();
        
        $segSize=$delta;
        $n=$size/$segSize;
       $isPList=array();
        for($x=0;$x<$segSize;$x=$x+1)
        {
            
            $isPList[$x]=1;
            
        }
        
        $p=2;
        while($p<=sqrt($segSize))
            {
            if($isPList[$p])
            {
                
                $j=$p*$p;
                $k=1;
                while($j<$segSize)
                {
                    
                   $isPList[$j]=0;
                 
                    $j=$p*$p+$p*$k;
                    $k=$k+1;
                }
               
               
               
            }
            $p=$p+1;
            }
        $len=0;
        for($i=0;$i<sizeof($isPList);$i=$i+1)
        {
            if($isPList[$i]==1)
            {
            $plist[$len]=$i;
            $len=$len+1;
            }
        }
        for($a=2;$a<=$n;$a=$a+1)
        $plist=extend($plist, $a, $segSize);
       
       return $plist;
    }  
function getSprime($plist)
{
    $sprime=array();
    $sprime[0]=0;
    for($i=3;$i<sizeof($plist);$i=$i+1)
    {
        $sprime[$i-2]=$plist[$i-1]+$sprime[$i-3];
        
    }
    return $sprime;
}
function exe($limit){
    
    $plist=Prime($limit, 10000);
    $sprime=getSprime($plist);    
    $m=-1;
    $p=-1;
    for($i=2;$i<sizeof($plist);$i=$i+1)
    {
        for($j=0;$j<$i-2;$j=$j+1)
        {
            if($sprime[$i-2]-$sprime[$j]>$limit)
                break;
            $conSum=$sprime[$i-2]-$sprime[$j];
            if(array_search($conSum, $plist)!=false)
            {
                
                if($m<$i-$j-1)
                {
                    $m=$i-$j-1;
                    $p=$conSum;
                }
            }
        }
    }
    return $p;
}
echo exe(100000);

?>


</body>
</html>