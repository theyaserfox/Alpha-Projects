﻿#pragma checksum "..\..\..\Videos.xaml" "{406ea660-64cf-4c82-b6f0-42d48172a799}" "0C8A13AF722089E018778563BECD9B6E"
//------------------------------------------------------------------------------
// <auto-generated>
//     This code was generated by a tool.
//     Runtime Version:4.0.30319.17929
//
//     Changes to this file may cause incorrect behavior and will be lost if
//     the code is regenerated.
// </auto-generated>
//------------------------------------------------------------------------------

using System;
using System.Diagnostics;
using System.Windows;
using System.Windows.Automation;
using System.Windows.Controls;
using System.Windows.Controls.Primitives;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Forms.Integration;
using System.Windows.Ink;
using System.Windows.Input;
using System.Windows.Markup;
using System.Windows.Media;
using System.Windows.Media.Animation;
using System.Windows.Media.Effects;
using System.Windows.Media.Imaging;
using System.Windows.Media.Media3D;
using System.Windows.Media.TextFormatting;
using System.Windows.Navigation;
using System.Windows.Shapes;
using System.Windows.Shell;


namespace HmiLike {
    
    
    /// <summary>
    /// Videos
    /// </summary>
    public partial class Videos : System.Windows.Controls.UserControl, System.Windows.Markup.IComponentConnector {
        
        
        #line 18 "..\..\..\Videos.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.Button Video1;
        
        #line default
        #line hidden
        
        
        #line 19 "..\..\..\Videos.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.Button Video2;
        
        #line default
        #line hidden
        
        
        #line 20 "..\..\..\Videos.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.Button Video3;
        
        #line default
        #line hidden
        
        
        #line 21 "..\..\..\Videos.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.Button Video4;
        
        #line default
        #line hidden
        
        
        #line 22 "..\..\..\Videos.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.Button Home;
        
        #line default
        #line hidden
        
        private bool _contentLoaded;
        
        /// <summary>
        /// InitializeComponent
        /// </summary>
        [System.Diagnostics.DebuggerNonUserCodeAttribute()]
        [System.CodeDom.Compiler.GeneratedCodeAttribute("PresentationBuildTasks", "4.0.0.0")]
        public void InitializeComponent() {
            if (_contentLoaded) {
                return;
            }
            _contentLoaded = true;
            System.Uri resourceLocater = new System.Uri("/HmiLike;component/videos.xaml", System.UriKind.Relative);
            
            #line 1 "..\..\..\Videos.xaml"
            System.Windows.Application.LoadComponent(this, resourceLocater);
            
            #line default
            #line hidden
        }
        
        [System.Diagnostics.DebuggerNonUserCodeAttribute()]
        [System.CodeDom.Compiler.GeneratedCodeAttribute("PresentationBuildTasks", "4.0.0.0")]
        [System.ComponentModel.EditorBrowsableAttribute(System.ComponentModel.EditorBrowsableState.Never)]
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Design", "CA1033:InterfaceMethodsShouldBeCallableByChildTypes")]
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Maintainability", "CA1502:AvoidExcessiveComplexity")]
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1800:DoNotCastUnnecessarily")]
        void System.Windows.Markup.IComponentConnector.Connect(int connectionId, object target) {
            switch (connectionId)
            {
            case 1:
            this.Video1 = ((System.Windows.Controls.Button)(target));
            
            #line 18 "..\..\..\Videos.xaml"
            this.Video1.Click += new System.Windows.RoutedEventHandler(this.Video1_Click);
            
            #line default
            #line hidden
            return;
            case 2:
            this.Video2 = ((System.Windows.Controls.Button)(target));
            
            #line 19 "..\..\..\Videos.xaml"
            this.Video2.Click += new System.Windows.RoutedEventHandler(this.Video2_Click);
            
            #line default
            #line hidden
            return;
            case 3:
            this.Video3 = ((System.Windows.Controls.Button)(target));
            
            #line 20 "..\..\..\Videos.xaml"
            this.Video3.Click += new System.Windows.RoutedEventHandler(this.Video3_Click);
            
            #line default
            #line hidden
            return;
            case 4:
            this.Video4 = ((System.Windows.Controls.Button)(target));
            
            #line 21 "..\..\..\Videos.xaml"
            this.Video4.Click += new System.Windows.RoutedEventHandler(this.Video4_Click);
            
            #line default
            #line hidden
            return;
            case 5:
            this.Home = ((System.Windows.Controls.Button)(target));
            
            #line 22 "..\..\..\Videos.xaml"
            this.Home.Click += new System.Windows.RoutedEventHandler(this.Home_Click);
            
            #line default
            #line hidden
            return;
            }
            this._contentLoaded = true;
        }
    }
}
