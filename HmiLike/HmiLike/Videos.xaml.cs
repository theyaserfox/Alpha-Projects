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
    /// Interaction logic for Videos.xaml
    /// </summary>
    public partial class Videos : UserControl
    {
        MediaPlayer player = new MediaPlayer();
        MediaPlayer player1 = new MediaPlayer();
        MediaPlayer player2 = new MediaPlayer();
        MediaPlayer player3 = new MediaPlayer();
        public Videos()
        {
            InitializeComponent();
        }
        private void Video1_Click(object sender, RoutedEventArgs e)
        {
            /* QuackMediaElement2.Close();
             QuackMediaElement.Play();*/

            player.Open(new Uri("E:\\Users\\Eslam\\Downloads\\Video\\New folder\\3.mp4", UriKind.Relative));
            VideoDrawing drawing = new VideoDrawing { Rect = new Rect(0, 0, 400, 400), Player = player };
            player.Play();
            DrawingBrush brush = new DrawingBrush(drawing);
            Background = brush;
            player1.Close();
            player2.Close();
            player3.Close();
        }
        private void Window_Loaded(object sender, RoutedEventArgs e)
        {


        }

        private void Video2_Click(object sender, RoutedEventArgs e)
        {
            /* QuackMediaElement2.Play();
             QuackMediaElement.Close();*/
            player1.Open(new Uri("E:\\Users\\Eslam\\Downloads\\Video\\New folder\\7.mp4", UriKind.Relative));
            VideoDrawing drawing = new VideoDrawing { Rect = new Rect(0, 0, 400, 400), Player = player1 };
            player1.Play();
            DrawingBrush brush = new DrawingBrush(drawing);
            Background = brush;
            player.Close();
            player2.Close();
            player3.Close();
        }


        private void Grid_Loaded_1(object sender, RoutedEventArgs e)
        {

        }

        private void Video3_Click(object sender, RoutedEventArgs e)
        {
            player2.Open(new Uri("E:\\Users\\Eslam\\Downloads\\Video\\New folder\\6.mp4", UriKind.Relative));
            VideoDrawing drawing = new VideoDrawing { Rect = new Rect(0, 0, 400, 400), Player = player2 };
            player2.Play();
            DrawingBrush brush = new DrawingBrush(drawing);
            Background = brush;
            player.Close();
            player1.Close();
            player3.Close();
        }

        private void Video4_Click(object sender, RoutedEventArgs e)
        {
            player3.Open(new Uri("E:\\Users\\Eslam\\Downloads\\Video\\New folder\\1.avi", UriKind.Relative));
            VideoDrawing drawing = new VideoDrawing { Rect = new Rect(0, 0, 400, 400), Player = player3 };
            player3.Play();
            DrawingBrush brush = new DrawingBrush(drawing);
            Background = brush;
            player.Close();
            player1.Close();
            player2.Close();
        }

        private void Home_Click(object sender, RoutedEventArgs e)
        {
            Switcher.Switch(new HmiLike.Pages.Page1());
            player.Close();
            player1.Close();
            player2.Close();
            player3.Close();
        }
    }
}
