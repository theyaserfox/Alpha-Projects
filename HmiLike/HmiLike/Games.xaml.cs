using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Threading.Tasks;
using System.Windows.Forms.Integration;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;
using System.Windows.Forms;
using HmiLike.Pages;



namespace HmiLike
{
    /// <summary>
    /// Interaction logic for Games.xaml
    /// </summary>
    public partial class Games : System.Windows.Controls.UserControl
    {
       // FormFlashLibrary.FlashAxControl player1 = new FormFlashLibrary.FlashAxControl();

        public Games()
        {
            InitializeComponent();

         
        /*  string strFilePath = @"C:\Users\Islam Mostafa\Desktop\flash games\skyfighters\skyfighters.swf";
            SWFFileHeader swfFile = new SWFFileHeader(strFilePath);
            this.Width = swfFile.FrameSize.WidthInPixels;
            this.Height = swfFile.FrameSize.HeightInPixels + 160;

            WindowsFormsHost host = new WindowsFormsHost();
            //   FormFlashLibrary.FlashAxControl player = new FormFlashLibrary.FlashAxControl();

            //the Windows Forms Host hosts the Flash Player
            host.Child = player1;
            host.Width = (int)this.Width;
            host.Height = (int)this.Height - 160;
            host.VerticalAlignment = System.Windows.VerticalAlignment.Top;
            host.HorizontalAlignment = System.Windows.HorizontalAlignment.Left;

            //the WPF Grid hosts the Windows Forms Host
            //eslam.Children.Add(host);

            //set size
            player1.Width = (int)this.Width;
            player1.Height = (int)this.Height - 160;

         

            //  image3.Margin = new Thickness(280, player1.Height, 0, 0);

            //image4.Margin = new Thickness(420, player1.Height, 0, 0);
            //load & play the movie
            player1.LoadMovie(strFilePath);
            player1.Play();*/
           
        }

        private void Button_Click_1(object sender, RoutedEventArgs e)
        {
            Switcher.Switch(new Game1());

        }

        private void Button_Click_2(object sender, RoutedEventArgs e)
        {
            Switcher.Switch(new Game4());
            //player1.Dispose();

         
        }

        private void Button_Click_3(object sender, RoutedEventArgs e)
        {
            Switcher.Switch(new Page1());
        }

        private void Button_Click_4(object sender, RoutedEventArgs e)
        {
            Switcher.Switch(new Game2());
        }

        private void Button_Click_5(object sender, RoutedEventArgs e)
        {
            Switcher.Switch(new Game3());
        }
    }
}
