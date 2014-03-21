using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;
using SmartMergedTable;
using TouchFramework;
using TouchTrackingUnit;
namespace project
{
    /// <summary>
    /// Interaction logic for MainWindow.xaml
    /// </summary>
    public partial class MainWindow : Window
    {
        bool ToIn = false, ToOut = false;
        bool fullscreen = true;
        Dictionary<int, UIElement> points = new Dictionary<int, UIElement>();
        public static FrameworkControl framework = null;

        private SMTGrid main;
        private SMTGrid main2;
        private SMTGrid main1;
        public MainWindow()
        {
            InitializeComponent();
            Tracking();
            main = new SMTGrid();
            main.Background = Brushes.Black;
            main.Margin = new Thickness(10,10,0,0);
            main.VerticalAlignment = System.Windows.VerticalAlignment.Top;
            main.HorizontalAlignment = System.Windows.HorizontalAlignment.Left;
            main.Width =300;
            main.Height = 300;
            main.RegisterThisElement(framework, GRD);
            main.touchDown += new SMTGrid.TouchDown(main_touchDown);    
            //main.MouseLeftButtonDown += new MouseButtonEventHandler(main_MouseLeftButtonDown);
            GRD.Children.Add(main);
            main1 = new SMTGrid();
            main1.Background = Brushes.Red;
            main1.Margin = new Thickness(310, 10, 0, 0);
            main1.VerticalAlignment = System.Windows.VerticalAlignment.Top;
            main1.HorizontalAlignment = System.Windows.HorizontalAlignment.Left;
            main1.Width = 300;
            main1.Height = 300;
            main1.RegisterThisElement(framework, GRD);
            main1.touchDown += new SMTGrid.TouchDown(main1_touchDown);
            //main1.MouseLeftButtonDown += new MouseButtonEventHandler(main1_MouseLeftButtonDown);
            GRD.Children.Add(main1);
            main2 = new SMTGrid();
            main2.Background = Brushes.Yellow;
            main2.Margin = new Thickness(610, 10, 0, 0);
            main2.VerticalAlignment = System.Windows.VerticalAlignment.Top;
            main2.HorizontalAlignment = System.Windows.HorizontalAlignment.Left;
            main2.Width = 300;
            main2.Height = 300;
            main2.RegisterThisElement(framework, GRD);
            main2.touchDown += new SMTGrid.TouchDown(main2_touchDown);
            //main2.MouseLeftButtonDown += new MouseButtonEventHandler(main2_MouseLeftButtonDown);
            GRD.Children.Add(main2);

        }

        void main2_touchDown(object sender, SmartMergedTable.Events.TouchDownEventArgs e)
        {
            MessageBox.Show("Yellow");
        }

        void main1_touchDown(object sender, SmartMergedTable.Events.TouchDownEventArgs e)
        {
            MessageBox.Show("Red");
        }

        void main_touchDown(object sender, SmartMergedTable.Events.TouchDownEventArgs e)
        {
            //SMTGrid m = (SMTGrid)sender;
            //DataObject dataObj = new dataObj();
            //DragDrop.DoDragDrop(m, dataObj, DragDropEffects.Move);
            MessageBox.Show("Black");
        }

        void main1_MouseLeftButtonDown(object sender, MouseButtonEventArgs e)
        {
            MessageBox.Show("Red");
        }

        void main2_MouseLeftButtonDown(object sender, MouseButtonEventArgs e)
        {
            MessageBox.Show("Yellow");
           
        }

        void main_MouseLeftButtonDown(object sender, MouseButtonEventArgs e)
        {
            MessageBox.Show("black");
        }

        #region tracking
        public void Tracking()
        {
            framework = TrackingHelper.GetTuioTracking(GRD);
            framework.OnProcessUpdates += new FrameworkControl.ProcessUpdatesDelegate(this.DisplayPoints);
            framework.Start();
            //  framework.RegisterElement(this.mTGrid);

        }
        void DisplayPoints()
        {
            foreach (int i in points.Keys)
            {
                if (!framework.AllTouches.ContainsKey(i))
                {
                    GRD.Children.Remove(points[i]);

                }
            }
            foreach (TouchFramework.Touch te in framework.AllTouches.Values)
            {
                DisplayPoint(te.TouchId, te.TouchPoint);
            }
        }
        void DisplayPoint(int id, System.Drawing.PointF p)
        {
            DisplayPoint(id, p, System.Windows.Media.Colors.White);
        }
        void DisplayPoint(int id, System.Drawing.PointF p, System.Windows.Media.Color brushColor)
        {
            Console.WriteLine(p.ToString());
            System.Windows.Shapes.Ellipse e = null;
            if (points.ContainsKey(id))
            {
                e = points[id] as Ellipse;
                e.RenderTransform = new TranslateTransform(p.X - 13, p.Y - 13);
            }

            if (e == null)
            {
                e = new Ellipse();

                RadialGradientBrush radialGradient = new RadialGradientBrush();
                radialGradient.GradientOrigin = new System.Windows.Point(0.5, 0.5);
                radialGradient.Center = new System.Windows.Point(0.5, 0.5);
                radialGradient.RadiusX = 0.5;
                radialGradient.RadiusY = 0.5;

                System.Windows.Media.Color shadow = Colors.Black;
                shadow.A = 30;
                radialGradient.GradientStops.Add(new GradientStop(shadow, 0.9));
                brushColor.A = 60;
                radialGradient.GradientStops.Add(new GradientStop(brushColor, 0.8));
                brushColor.A = 150;
                radialGradient.GradientStops.Add(new GradientStop(brushColor, 0.1));

                radialGradient.Freeze();

                e.Height = 26.0;
                e.Width = 26.0;
                e.Fill = radialGradient;

                int eZ = framework.MaxZIndex + 100;
                e.IsHitTestVisible = false;
                e.RenderTransform = new TranslateTransform(p.X - 3, p.Y - 3);
                GRD.Children.Add(e);
                e.VerticalAlignment = System.Windows.VerticalAlignment.Top;
                e.HorizontalAlignment = System.Windows.HorizontalAlignment.Left;
                Panel.SetZIndex(e, eZ);
                points.Add(id, e);
            }
        }
        public void takeBackground()
        {
            framework.ForceRefresh();
        }

        void toggleFullscreen()
        {
            if (!fullscreen) switchFullScreen(); else switchWindowed();
        }
        void switchWindowed()
        {
            fullscreen = false;
        }

        void switchFullScreen()
        {

            fullscreen = true;
        }

        #endregion
    }
}
