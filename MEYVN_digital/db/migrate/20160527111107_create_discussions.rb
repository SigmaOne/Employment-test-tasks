class CreateDiscussions < ActiveRecord::Migration[5.0]
  def change
    create_table :discussions do |t|
      t.string :topic
      t.timestamps
    end

    add_reference :discussions, :event, index: true, foreign_key: true
  end
end
