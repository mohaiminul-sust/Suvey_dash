<!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              {{Date('Y')}} &copy; {{ Config::get('customConfig.siteName') }}
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->

</section>

	  {{ HTML::script('js/jquery.js') }}
  	{{ HTML::script('js/bootstrap.min.js') }}
  	{{ HTML::script('js/jquery.dcjqaccordion.2.7.js', array('class' => 'include')) }}
  	{{ HTML::script('js/jquery.scrollTo.min.js') }}
  	{{ HTML::script('js/jquery.nicescroll.js') }}
  	{{ HTML::script('js/respond.min.js') }}
    {{ HTML::script('js/slidebars.min.js') }}
  	{{ HTML::script('js/common-scripts.js') }}
    <!-- start Mixpanel --><script type="text/javascript">(function(e,b){if(!b.__SV){var a,f,i,g;window.mixpanel=b;b._i=[];b.init=function(a,e,d){function f(b,h){var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}var c=b;"undefined"!==typeof d?c=b[d]=[]:d="mixpanel";c.people=c.people||[];c.toString=function(b){var a="mixpanel";"mixpanel"!==d&&(a+="."+d);b||(a+=" (stub)");return a};c.people.toString=function(){return c.toString(1)+".people (stub)"};i="disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
      for (g = 0; g < i.length; g++) f(c, i[g]);
      b._i.push([a, e, d])
      };
      b.__SV = 1.2;
      a = e.createElement("script");
      a.type = "text/javascript";
      a.async = !0;
      a.src = "undefined" !== typeof MIXPANEL_CUSTOM_LIB_URL ? MIXPANEL_CUSTOM_LIB_URL : "file:" === e.location.protocol && "//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//) ? "https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js" : "//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";
      f = e.getElementsByTagName("script")[0];
      f.parentNode.insertBefore(a, f)
      }
      })(document, window.mixpanel || []);
      mixpanel.init("4e0a56ab118f7ae3212bacfeda6e8226"); </script><!-- end Mixpanel -->
  	@yield('script')
  	{{-- {{ HTML::script('js/custom.js') }} --}}
