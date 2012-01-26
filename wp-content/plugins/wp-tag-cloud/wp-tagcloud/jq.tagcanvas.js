/**
 * Copyright (C) 2010 Graham Breach
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
/**
 * jQuery.tagcanvas 1.2
 * For more information, please contact <graham@goat1000.com>
 */

(function($) {
var jqt = {
	Point3D : function(x,y,z) { this.x = x; this.y = y; this.z = z; },
	RotX : function(p1,t) {
		var s = Math.sin(t), c = Math.cos(t); 
		return new jqt.Point3D(p1.x, (p1.y * c) + (p1.z * s), (p1.y * -s) + (p1.z * c));
	},
	RotY : function(p1,t) {
		var s = Math.sin(t), c = Math.cos(t); 
		return new jqt.Point3D((p1.x * c) + (p1.z * -s), p1.y, (p1.x * s) + (p1.z * c));
	},
	RotZ : function(p1,t) {
		var s = Math.sin(t), c = Math.cos(t); 
		return new jqt.Point3D((p1.x * c) + (p1.y * s), (p1.x * -s) + (p1.y * c),
			p1.z);
	},
	Project : function(p1,w,h,fov,asp) {
		var yn, xn, zn;
		yn = (p1.y  * jqt.z1) / (jqt.z1 + jqt.z2 + p1.z);
		xn = (p1.x  * jqt.z1) / (jqt.z1 + jqt.z2 + p1.z);
		zn = jqt.z2 + p1.z;
		return new jqt.Point3D(xn, yn, zn);
	},
	Draw : function(cv) {
		var max_sc = 0, x1, y1, c, a, i;
		c = cv.getContext('2d');
		c.clearRect(0,0,cv.width,cv.height);
		c.strokeStyle = 'white';
		c.fillStyle = 'white';
		x1 = cv.width / 2;
		y1 = cv.height / 2;
		this.active = null;
		for(i = 0; i < this.taglist.length; ++i)
		{
			a = this.taglist[i].Draw(c, x1, y1, this.yaw, this.pitch);
			if(a && a.sc > max_sc)
			{
				this.active = a;
				this.active.index = i;
				max_sc = a.sc;
			}
		}
		if(jqt.freezeActive && this.active)
			this.yaw = this.pitch = 0;
		else
			this.Animate(cv.width, cv.height);
		if(this.active)
			this.active.Draw(c);
	},
	Animate : function(w,h) {
		if(jqt.mx >= 0 && jqt.my >= 0 &&
				jqt.mx < w && jqt.my < h)
		{
			this.yaw = (jqt.maxSpeed * 2 * jqt.mx / w) - jqt.maxSpeed;
			this.pitch = -((jqt.maxSpeed * 2 * jqt.my / h) - jqt.maxSpeed);
			if(jqt.reverse)
			{
				this.yaw = -this.yaw;
				this.pitch = -this.pitch;
			}
			jqt.initial = null;
		}
		else if(!jqt.initial)
		{
			this.yaw = this.yaw * jqt.decel;
			this.pitch = this.pitch * jqt.decel;
		}
	},
	Clicked : function(e) {
		try {
			if(this.active && this.taglist[this.active.index]) 
				this.taglist[this.active.index].Clicked(e);
		} catch(ex) {
			//window.alert(ex);
		}
	},
	Outline : function(x,y,w,h,sc) {
		this.ts = new Date();
		this.Update = function(x,y,w,h,sc) {
			this.x = x; this.y = y;
			this.w = w; this.h = h;
			this.sc = sc;
		};
		this.Draw = function(c) {
			var diff = new Date() - this.ts;
			c.save();
			c.scale(this.sc, this.sc);
			c.strokeStyle = jqt.outlineColour;
			c.lineWidth = jqt.outlineThickness;
			if(jqt.pulsateTo < 1.0) {
				c.globalAlpha = jqt.pulsateTo + ((1.0 - jqt.pulsateTo) * 
					(0.5 + (Math.cos(2 * Math.PI * diff / (1000 * jqt.pulsateTime)) / 2.0)));
			}
			c.beginPath();
			c.rect(this.x-jqt.outlineOffset, this.y-jqt.outlineOffset,
				this.w+jqt.outlineOffset*2, this.h+jqt.outlineOffset*2);
			c.closePath();
			c.stroke();
			c.restore();
		};
		this.Update(x,y,w,h,sc);
	},
	Tag : function(name,href,target,v,w,h) {
		this.name = name;
		this.href = href;
		this.target = target;
		this.p3d = new jqt.Point3D;
		this.p3d.x = v[0] * jqt.radius * 1.1;
		this.p3d.y = v[1] * jqt.radius * 1.1;
		this.p3d.z = v[2] * jqt.radius * 1.1;
		this.x = 0;
		this.y = 0;
		this.w = w;
		this.h = h;
		this.sc = 1;
		this.alpha = 1;

		this.Draw = function(c,xoff,yoff,yaw,pitch) {
			var m;
			this.Calc(yaw,pitch);
			c.save();
			c.globalAlpha = this.alpha;
			c.scale(this.sc, this.sc);
			c.textBaseline = 'top';
			c.fillStyle = jqt.textColour;
			c.font = jqt.textHeight + 'px ' + jqt.textFont;
			m = c.measureText(this.name);
			this.w = ((m.width + 2) * this.sc);
			this.h1 = this.h * this.sc;
			xoff = (xoff - this.w / 2) / this.sc;
			yoff = (yoff - this.h1 / 2) / this.sc;
			this.w = m.width + 2;
			this.h1 = this.h + 2;

			c.fillText(this.name, xoff + this.x + 1, yoff + this.y + 1, this.w - 2);
			c.beginPath();
			c.rect(xoff + this.x, yoff + this.y, this.w, this.h1);
			c.closePath();
			c.restore();
			if(c.isPointInPath(jqt.mx, jqt.my))
			{
				if(this.active)
					this.active.Update(xoff + this.x, yoff + this.y, this.w, this.h1, this.sc);
				else
					this.active = new jqt.Outline(xoff + this.x, yoff + this.y,
						this.w, this.h1, this.sc);
			}
			else
				this.active = null;
			return this.active;
		};
		this.Calc = function(yaw,pitch) {
			var pp = jqt.RotY(this.p3d,yaw);
			this.p3d = jqt.RotX(pp,pitch);

			pp = jqt.Project(this.p3d, this.w, this.h, Math.PI / 4, 20);
			this.x = pp.x;
			this.y = pp.y;
			this.sc = (jqt.z1 + jqt.z2 - pp.z) / jqt.z2;
			this.alpha = jqt.minBrightness + 1 -
				((pp.z - jqt.z2 + jqt.radius) / (2 * jqt.radius));
		};
		this.Clicked = function(e) {
			if(this.target == '' || this.target == '_self')
				document.location = this.href;
			else if(self.frames[this.target])
				self.frames[this.target] = this.href;
			else if(top.frames[this.target])
				top.frames[this.target] = this.href;
			else
				window.open(this.href, this.target);
		};
	},
	MouseMove : function(e) {
		jqt.mx = e.pageX - jqt.cx;
		jqt.my = e.pageY - jqt.cy;
	},
	MouseClick : function(e) {
		jqt.MouseMove(e);
		jqt.Clicked(e);
	},
	PointsOnSphere : function(n) {
		var i, y, r, phi, pts = [], inc = Math.PI * (3-Math.sqrt(5)), off = 2/n;
		for(i = 0; i < n; ++i) {
			y = i * off - 1 + (off / 2);
			r = Math.sqrt(1 - y*y);
			phi = i * inc;
			pts.push([Math.cos(phi)*r, y, Math.sin(phi)*r]);
		}
		return pts;
	},

	mx : -1, my : -1,
	cx : 0, cy : 0,
	z1 : 20000, z2 : 20000,
	freezeActive : false,
	pulsateTo : 1.0,
	pulsateTime : 3,
	reverse : false,
	depth : 0.5,
	maxSpeed : 0.05,
	decel : 0.95,
	initial : null,
	minBrightness : 0.1,
	outlineColour : '#ffff99',
	outlineThickness : 2,
	outlineOffset : 5,
	textColour : '#ff99ff',
	textHeight : 15,
	textFont : 'Helvetica, Arial, sans-serif'
};

jQuery.fn.tagcanvas = function(options) {
	var links = this.find('a'), offset = this.offset(), canvas = this.eq(0), i;
	if(!links.length || !canvas[0].getContext || !canvas[0].getContext('2d').fillText)
		return false;

	for(i in options)
		jqt[i] = options[i];

	jqt.z1 = (19800 / (Math.exp(jqt.depth) * (1-1/Math.E))) +
		20000 - 19800 / (1-(1/Math.E));
	jqt.z2 = jqt.z1;
	canvas.each(function() {
		var i, vl;

		jqt.radius = (this.height > this.width ? this.width : this.height)
			* 0.33 * (jqt.z2 + jqt.z1) / (jqt.z1);
		jqt.taglist = [];

		vl = jqt.PointsOnSphere(links.length);
		for(i = 0; i < links.length; ++i) {
			jqt.taglist.push(new jqt.Tag(
					links[i].textContent, links[i].href, links[i].target,
					vl[i], 10, jqt.textHeight));
		}

		jqt.yaw = jqt.initial ? jqt.initial[0] * jqt.maxSpeed : 0;
		jqt.pitch = jqt.initial ? jqt.initial[1] * jqt.maxSpeed : 0;
		jqt.cx = offset.left;
		jqt.cy = offset.top;
		setInterval(function() { jqt.Draw(canvas[0]); }, 10);
		document.addEventListener('mousemove', jqt.MouseMove, false);
		document.addEventListener('mouseout', jqt.MouseMove, false);
		document.addEventListener('mousedown', jqt.MouseClick, false);
	});
	return true;
};
})(jQuery);
