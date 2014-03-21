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

namespace HmiLike
{
    /// <summary>
    /// Interaction logic for Video2.xaml
    /// </summary>
    public partial class Video2 : UserControl
    {
        MediaPlayer player1 = new MediaPlayer();

        public Video2()
        {
            InitializeComponent();

            player1.Open(new Uri("D:\\Users\\gateway\\Desktop\\HmiLike\\HmiLike\\1.avi", UriKind.Relative));
            VideoDrawing drawing = new VideoDrawing { Rect = new Rect(0, 0, 400, 400), Player = player1 };
            player1.Play();
            DrawingBrush brush = new DrawingBrush(drawing);
            Background = brush;
        }

        private void Button_Click_1(object sender, RoutedEventArgs e)
        {
            Switcher.Switch(new Movies());
            player1.Close();

        }
    }
}
