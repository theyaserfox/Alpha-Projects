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
    /// Interaction logic for Viedo1.xaml
    /// </summary>
    public partial class Viedo1 : UserControl
    {
        MediaPlayer player = new MediaPlayer();
        public Viedo1()
        {
            InitializeComponent();
            player.Open(new Uri("D:\\Users\\gateway\\Desktop\\HmiLike\\HmiLike\\3.mp4", UriKind.Relative));
            VideoDrawing drawing = new VideoDrawing { Rect = new Rect(0, 0, 400, 400), Player = player };
            player.Play();
            DrawingBrush brush = new DrawingBrush(drawing);
            Background = brush;
        }

        private void Button_Click_1(object sender, RoutedEventArgs e)
        {
            player.Close();
            Switcher.Switch(new Movies());
        }
    }
}
