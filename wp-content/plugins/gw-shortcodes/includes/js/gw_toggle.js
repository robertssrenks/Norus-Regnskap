jQuery(function($){$(document).ready(function(){$("h5.toggle").click(function(){$(this).toggleClass("toggle-active").next().slideToggle("fast");return false;});});});