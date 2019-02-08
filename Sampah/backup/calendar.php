<CENTER>
<?
$special=array(6,17,21);
$tes ="1,2,3";
$totSpecial=count($special);
?>
<SCRIPT LANGUAGE="JavaScript">

specialDate = new Array(<?= $totSpecial?>);
specialDate[0]=20;

<!-- Begin
monthnames = new Array(
"Januari",
"Februari",
"Maret",
"April",
"Mei",
"Juni",
"Juli",
"Agustus",
"September",
"Oktober",
"Nopember",
"Desember");
var linkcount=0;
function addlink(month, day, href) {
var entry = new Array(3);
entry[0] = month;
entry[1] = day;
entry[2] = href;
this[linkcount++] = entry;
}
Array.prototype.addlink = addlink;
linkdays = new Array();
monthdays = new Array(12);
monthdays[0]=31;
monthdays[1]=28;
monthdays[2]=31;
monthdays[3]=30;
monthdays[4]=31;
monthdays[5]=30;
monthdays[6]=31;
monthdays[7]=31;
monthdays[8]=30;
monthdays[9]=31;
monthdays[10]=30;
monthdays[11]=31;

<?
$sekarang = date("d M Y");
?>;
sekarang="<? echo $sekarang ?>";
todayDate=new Date(sekarang);

thisday=todayDate.getDay();
thismonth=todayDate.getMonth();
thisdate=todayDate.getDate();
thisyear=todayDate.getYear();
thisyear = thisyear % 100;
thisyear = ((thisyear < 50) ? (2000 + thisyear) : (1900 + thisyear));
if (((thisyear % 4 == 0) 
&& !(thisyear % 100 == 0))
||(thisyear % 400 == 0)) monthdays[1]++;
startspaces=thisdate;
while (startspaces > 7) startspaces-=7;
startspaces = thisday - startspaces + 1;
if (startspaces < 0) startspaces+=7;
document.write("<table border=0 cellspacing=1 cellpadding=0 ");
document.write("bordercolor=#CCCCCC width=100%><font color=black>");
document.write("<tr><td colspan=7><center><strong><font size=2>" 
+ monthnames[thismonth] + " " + thisyear 
+ "</font></strong></center></font></td></tr>");
document.write("<tr>");
document.write("<td align=center><font size=1 color=red>Ming</font></td>");
document.write("<td align=center><font size=1>Sen</font></td>");
document.write("<td align=center><font size=1>Sel</font></td>");
document.write("<td align=center><font size=1>Rab</font></td>");
document.write("<td align=center><font size=1>Kam</font></td>");
document.write("<td align=center><font size=1 color=green>Jum</font></td>");
document.write("<td align=center><font size=1>Sab</font></td>"); 
document.write("</tr>");
document.write("<tr>");
for (s=0;s<startspaces;s++) {
document.write("<td> </td>");
}
count=1;
index=0;
while (count <= monthdays[thismonth]) {
	for (b = startspaces;b<7;b++) {
		linktrue=false;
		document.write("<td align=center><font size=1>");
		for (c=0;c<linkdays.length;c++) {
			if (linkdays[c] != null) {
				if ((linkdays[c][0]==thismonth + 1) && (linkdays[c][1]==count)) {
					document.write("<a href=\"" + linkdays[c][2] +"\">");
					linktrue=true;
    				}
   				}
			}
		if (count <= monthdays[thismonth]) {
			if (b==0) {
				document.write("<div style='background-color:#FFDFE0'><font color=red>");}
			if (b==5) {
				document.write("<div style='background-color:#DFFDC4'><font color=green>");}
			if (count==thisdate) {
				document.write("<div style='background-color:#D6E4F8'><font size=2 color=blue ><strong>");}
			
			if(count==specialDate[index]){
				document.write("["+count+"]");
			}
			else{
				document.write(count);
			}
			
			if (count==thisdate) {
				document.write("</strong></font></div>");}			
			if (b==0){
				document.write("</font></div>");}
			if (b==5){
				document.write("</font></div>");}

			}
		else {
		document.write(" ");
			}
		if (linktrue)
			document.write("</a>");
		document.write("</font></td>");
		count++;
		}
	document.write("</tr>");
	document.write("<tr>");
	startspaces=0;
	index=index+1;
}
document.write("</table>");
// End -->
</SCRIPT>