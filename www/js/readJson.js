	function readJsonTiles() {
		var a = "";
		$.ajax({
			url: "data.json",
			dataType: "json",
			async: false,
			success: function(data) {
				for(var i in data.tiles) {
					if(data.tiles[i].typebody == 7) {
						a += "<a onclick=\""+data.tiles[i].html+"\"><div class=\""+data.tiles[i].tile+"\">"
					}
					else if (data.tiles[i].html == "") {
						a += "<div class=\""+data.tiles[i].tile+"\">"
					}
		            else {
		                a += "<a href=\"" + data.tiles[i].html + "\"><div class=\"" + data.tiles[i].tile + "\">"
		            }

					if(data.tiles[i].typebody == 1 || data.tiles[i].typebody == 7) {
						a +="<div class=\"tile-body\"><i class=\""+data.tiles[i].img+"\"></i></div>";
					}
					else if (data.tiles[i].typebody == 2) {
						a +="<img src=\""+data.tiles[i].img+"\" width=115 height=115 VSPACE=0 alt=\"\">";
					}
					else if (data.tiles[i].typebody == 3) {
						a +="<div class=\"tile-body\"><div class=\"main_align\"style=\"font-size:30px; padding-top:40%\">"+data.tiles[i].img+"</div></div>";
					}
					else if (data.tiles[i].typebody == 4) {
						a +="<div class=\"tile-body\"><img src=\""+data.tiles[i].img+"\" alt=\"\"></div>";
					}
					else if (data.tiles[i].typebody == 5) {
						a +="<div class=\"tile-body\">"+data.tiles[i].img+"</div>";
					}
					else if (data.tiles[i].typebody == 6) {
						a +="<div class=\"tile-body\">"+data.tiles[i].img+"</div>";
						data.tiles[i].name = "<i class=\""+data.tiles[i].name+"\"></i>";
					}
					a +="<div class=\"tile-object\"><div class=\"name\">"+data.tiles[i].name+"</div><div class=\"number\">"+data.tiles[i].number+"</div></div></div></a>";
				}
			}
		});
		return a;
	};


	function readJsonSubTiles(indexTile) {
		var a = "";
		$.ajax({
			url: "data.json",
			dataType: "json",
			async: false,
			success: function(data) {
				
				for(var i in data.tiles[indexTile].subtiles) {
				if(data.tiles[indexTile].subtiles[i].typebody == 7) {
					a += "<a onclick=\""+data.tiles[indexTile].subtiles[i].html+"\"><div class=\""+data.tiles[indexTile].subtiles[i].tile+"\">"
				}
				else if (data.tiles[indexTile].subtiles[i].html == "") {
						a += "<div class=\""+data.tiles[indexTile].subtiles[i].tile+"\">"
					}
				else {
					a += "<a href=\""+data.tiles[indexTile].subtiles[i].html+"\"><div class=\""+data.tiles[indexTile].subtiles[i].tile+"\">"
				}

					if(data.tiles[indexTile].subtiles[i].typebody == 1 || data.tiles[indexTile].subtiles[i].typebody == 7) {	
						a +="<div class=\"tile-body\"><i class=\""+data.tiles[indexTile].subtiles[i].img+"\"></i></div>";
					}
					else if (data.tiles[indexTile].subtiles[i].typebody == 2) {
						a +="<img src=\""+data.tiles[indexTile].subtiles[i].img+"\" width=115 height=115 VSPACE=0 alt=\"\">";
					}
					else if (data.tiles[indexTile].subtiles[i].typebody == 3) {
						a +="<div class=\"tile-body\"><div class=\"main_align\"style=\"font-size:30px; padding-top:40%\">"+data.tiles[0].subtiles[i].img+"</div></div>";
					}
					else if (data.tiles[indexTile].subtiles[i].typebody == 4) {
						a +="<div class=\"tile-body\"><img src=\""+data.tiles[indexTile].subtiles[i].img+"\" alt=\"\"></div>";
					}
					else if (data.tiles[indexTile].subtiles[i].typebody == 5) {
						a +="<div class=\"tile-body\">"+data.tiles[indexTile].subtiles[i].img+"</div>";
					}
					else if (data.tiles[indexTile].subtiles[i].typebody == 6) {
					    a += "<div class=\"tile-body\">" + data.tiles[indexTile].subtiles[i].img + "</div>";
						data.tiles[indexTile].subtiles[i].name = "<i class=\""+data.tiles[indexTile].subtiles[i].name+"\"></i>";
					}
		a += "<div class=\"tile-object\"><div class=\"name\">" + data.tiles[indexTile].subtiles[i].name + "</div><div class=\"number\">" + data.tiles[indexTile].subtiles[i].number + "</div></div></div></a>";
				}
			}
		});
		return a;
};

function readJsonSubTilesDegree2(indexTile, indexTile2) {
    var a = "";
    $.ajax({
        url: "data.json",
        dataType: "json",
        async: false,
        success: function (data) {

            for (var i in data.tiles[indexTile].subtiles[indexTile2].subtiles) {
				if (data.tiles[indexTile].subtiles[indexTile2].subtiles[i].html == "") {
						a += "<div class=\""+data.tiles[indexTile].subtiles[indexTile2].subtiles[i].tile+"\">"
					}
				else {
					a += "<a href=\"" + data.tiles[indexTile].subtiles[indexTile2].subtiles[i].html + "\"><div class=\"" + data.tiles[indexTile].subtiles[indexTile2].subtiles[i].tile + "\">"
                }
				if (data.tiles[indexTile].subtiles[indexTile2].subtiles[i].typebody == 1) {
                    a += "<div class=\"tile-body\"><i class=\"" + data.tiles[indexTile].subtiles[indexTile2].subtiles[i].img + "\"></i></div>";
                }
                else if (data.tiles[indexTile].subtiles[indexTile2].subtiles[i].typebody == 2) {
                    a += "<img src=\"" + data.tiles[indexTile].subtiles[indexTile2].subtiles[i].img + "\" width=115 height=115 VSPACE=0 alt=\"\">";
                }
                else if (data.tiles[indexTile].subtiles[indexTile2].subtiles[i].typebody == 3) {
                    a += "<div class=\"tile-body\"><div class=\"main_align\"style=\"font-size:30px; padding-top:40%\">" + data.tiles[0].subtiles[i].img + "</div></div>";
                }
                else if (data.tiles[indexTile].subtiles[indexTile2].subtiles[i].typebody == 4) {
                    a += "<div class=\"tile-body\"><img src=\"" + data.tiles[indexTile].subtiles[indexTile2].subtiles[i].img + "\" alt=\"\"></div>";
                }
                else if (data.tiles[indexTile].subtiles[indexTile2].subtiles[i].typebody == 5) {
                    a += "<div class=\"tile-body\">" + data.tiles[indexTile].subtiles[indexTile2].subtiles[i].img + "</div>";
                }
                else if (data.tiles[indexTile].subtiles[indexTile2].subtiles[i].typebody == 6) {
                    a += "<div class=\"tile-body\">" + data.tiles[indexTile].subtiles[indexTile2].subtiles[i].img + "</div>";
                    data.tiles[indexTile].subtiles[indexTile2].subtiles[i].name = "<i class=\"" + data.tiles[indexTile].subtiles[indexTile2].subtiles[i].name + "\"></i>";
                }
                a += "<div class=\"tile-object\"><div class=\"name\">" + data.tiles[indexTile].subtiles[indexTile2].subtiles[i].name + "</div><div class=\"number\">" + data.tiles[indexTile].subtiles[indexTile2].subtiles[i].number + "</div></div></div></a>";
            }
        }
    });
    return a;
};

function readJsonSubTilesDegree3(indexTile, indexTile2, indexTile3) {
    var a = "";
    $.ajax({
        url: "data.json",
        dataType: "json",
        async: false,
        success: function (data) {

            for (var i in data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles) {
				if (data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[i].html == "") {
					a += "<div class=\""+data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[i].tile+"\">"
				}
				else {
					a += "<a href=\"" + data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[i].html + "\"><div class=\"" + data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[i].tile + "\">"
                }
				if (data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[i].typebody == 1) {
                    a += "<div class=\"tile-body\"><i class=\"" + data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[i].img + "\"></i></div>";
                }
                else if (data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[i].typebody == 2) {
                    a += "<img src=\"" + data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[i].img + "\" width=115 height=115 VSPACE=0 alt=\"\">";
                }
                else if (data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[i].typebody == 3) {
                    a += "<div class=\"tile-body\"><div class=\"main_align\"style=\"font-size:30px; padding-top:40%\">" + data.tiles[0].subtiles[i].img + "</div></div>";
                }
                else if (data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[i].typebody == 4) {
                    a += "<div class=\"tile-body\"><img src=\"" + data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[i].img + "\" alt=\"\"></div>";
                }
                else if (data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[i].typebody == 5) {
                    a += "<div class=\"tile-body\">" + data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[i].img + "</div>";
                }
                else if (data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[i].typebody == 6) {
                    a += "<div class=\"tile-body\">" + data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[i].img + "</div>";
                    data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[i].name = "<i class=\"" + data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[i].name + "\"></i>";
                }
                a += "<div class=\"tile-object\"><div class=\"name\">" + data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[i].name + "</div><div class=\"number\">" + data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[i].number + "</div></div></div></a>";
            }
        }
    });
    return a;
};

function readJsonSubTilesDegree4(indexTile, indexTile2, indexTile3, indexTile4) {
    var a = "";
    $.ajax({
        url: "data.json",
        dataType: "json",
        async: false,
        success: function (data) {

            for (var i in data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[indexTile4].subtiles) {
                a += "<a href=\"" + data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[indexTile4].subtiles[i].html + "\"><div class=\"" + data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[indexTile4].subtiles[i].tile + "\">"
                if (data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[indexTile4].subtiles[i].typebody == 1) {
                    a += "<div class=\"tile-body\"><i class=\"" + data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[indexTile4].subtiles[i].img + "\"></i></div>";
                }
                else if (data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[indexTile4].subtiles[i].typebody == 2) {
                    a += "<img src=\"" + data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[indexTile4].subtiles[i].img + "\" width=115 height=115 VSPACE=0 alt=\"\">";
                }
                else if (data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[indexTile4].subtiles[i].typebody == 3) {
                    a += "<div class=\"tile-body\"><div class=\"main_align\"style=\"font-size:30px; padding-top:40%\">" + data.tiles[0].subtiles[i].img + "</div></div>";
                }
                else if (data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[indexTile4].subtiles[i].typebody == 4) {
                    a += "<div class=\"tile-body\"><img src=\"" + data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[indexTile4].subtiles[i].img + "\" alt=\"\"></div>";
                }
                else if (data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[indexTile4].subtiles[i].typebody == 5) {
                    a += "<div class=\"tile-body\">" + data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[indexTile4].subtiles[i].img + "</div>";
                }
                else if (data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[indexTile4].subtiles[i].typebody == 6) {
                    a += "<div class=\"tile-body\">" + data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[indexTile4].subtiles[i].img + "</div>";
                    data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[indexTile4].subtiles[i].name = "<i class=\"" + data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[indexTile4].subtiles[i].name + "\"></i>";
                }
                a += "<div class=\"tile-object\"><div class=\"name\">" + data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[indexTile4].subtiles[i].name + "</div><div class=\"number\">" + data.tiles[indexTile].subtiles[indexTile2].subtiles[indexTile3].subtiles[indexTile4].subtiles[i].number + "</div></div></div></a>";
            }
        }
    });
    return a;
};